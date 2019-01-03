<?php

namespace App\Matd;

use App\File\SimpleHeader;

class MatdHeader extends SimpleHeader
{    
    /**
     * Posição de cada campo
     *
     * @var array
     */
    protected $positionColumn = [
        'concessionaria' => null,
        'tag' => null,
        'placa' => null,
    ];

    /**
     * Campos obrigatórios no arquivo de leitura
     *
     * @var array
     */
    protected $columnRequired = ['concessionaria', 'tag', 'placa'];

    /**
     * Retorna as posições dos campos
     *
     * @param [type] $file
     * @return array
     */
    public function getPositions($file)
    {
        $sheet = $file->getActiveSheet();

        // logica para pegar as posições dos campos
        $columnCurrent = self::POSITION_COLUMN_START;
        $rowCurrent = self::POSTITION_ROW_START;

        do {
            $value = $this->getValueByColumnAndRow($sheet, $columnCurrent, $rowCurrent);
            $field = strtolower($value);

            if (!empty($field) && $this->isColumnRequired($field)) {
                $this->setPositionColumn($field, ['column' => $columnCurrent, 'row' => $rowCurrent]);
            }

            // ir para próxima linha quando chegar no final da coluna 
            if ($columnCurrent == self::POSITION_COLUMN_END) {
                $rowCurrent++;
                $columnCurrent = self::POSITION_COLUMN_START;
            }

            // sair do loop quando chegar no final da linha
            if ($rowCurrent == self::POSTITION_ROW_END) {
                break;
            }

            $columnCurrent++;

        } while (!$this->columnRequiredFound());

        return $this->positionColumn;
    }

    /**
     * Retorna o valor da celula
     *
     * @param [type] $sheet
     * @param integer $column
     * @param integer $row
     * @return string|null
     */
    protected function getValueByColumnAndRow($sheet, int $column, int $row)
    {
        return $sheet->getCellByColumnAndRow($column, $row)->getValue();
    }
}