<?php

namespace App\File;

abstract class SimpleHeader
{
    /**
     * Posição inicial da coluna para verificação
     */
    const POSITION_COLUMN_START = 1;

    /**
     * Posição final da coluna que irá verificar
     */
    const POSITION_COLUMN_END = 10;

    /**
     * Posição inicial da linha para verificação
     */
    const POSTITION_ROW_START = 1;

    /**
     * Posição final da linha que irá verificar
     */
    const POSTITION_ROW_END = 10; 

    /**
     * Posição de cada campo
     *
     * @var array
     */
    protected $positionColumn = [];

    /**
     * Campos requeridos no arquivo de leitura
     *
     * @var array
     */
    protected $columnRequired = [];

    /**
     * Retorna as posições dos campos
     *
     * @param [type] $file
     * @return array
     */
    public abstract function getPositions($file);
    
    /**
     * Retorna o valor da celula
     *
     * @param [type] $sheet
     * @param integer $column
     * @param integer $row
     * @return string|null
     */
    protected abstract function getValueByColumnAndRow($sheet, int $column, int $row);

    /**
     * Adiciona a posição do campo
     *
     * @param string $name
     * @param array $position
     * @return void
     */
    protected function setPositionColumn(string $name, array $position)
    {
        $this->positionColumn[$name] = $position;
    }

    /**
     * A coluna desejada já foi encontrada?
     *
     * @param string|null $name
     * @return boolean
     */
   protected function hasPositionColumn(string $name)
   {
       if (array_key_exists($name, $this->positionColumn) && is_null($this->positionColumn[$name])) {
           return true;
       }

       return false;
   }

   /**
    * Verifica se os campos requeridos foram encontrados
    *
    * @return bool
    */
   protected function columnRequiredFound()
   {
       foreach ($this->columnRequired as $column) {
           if (!$this->hasPositionColumn($column)) {
               return false;
           }
       }

       return true;
   }

   protected function isColumnRequired($column)
   {
       return in_array($column, $this->columnRequired);
   }
}