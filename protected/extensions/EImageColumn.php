<?php
/**
 * EImageColumn
 *
 * Allows to display image in CGridView column.
 *
 * @author Alexander Makarov
 *
 * @version 1.0
 *
 */
class EImageColumn extends CGridColumn {
    /**
         * @var string a PHP expression that is evaluated for every data cell and whose result
         * is used as the CSS class name for the data cell. In this expression, the variable
         * <code>$row</code> the row number (zero-based); <code>$data</code> the data model for the row;
         * and <code>$this</code> the column object.
         */
    public $imagePathExpression;

    /**
     * @var string Text that is used if cell is empty.
     */
    public $emptyText = '—';

    /**
     * @var int Image width.
     */
    public $width = null;

    /**
     * @var int Image height.
     */
    public $height = null;

    /**
         * Renders the data cell content.        
         * @param integer the row number (zero-based)
         * @param mixed the data associated with the row
         */
        protected function renderDataCellContent($row,$data){
        $content = $this->emptyText;
        if($this->imagePathExpression!==null && $imagePath = $this->evaluateExpression($this->imagePathExpression,array('row'=>$row,'data'=>$data))){
            $options = array();
            $options['src'] = $imagePath;
            if($this->width) $options['width'] = $this->width;
            if($this->height) $options['height'] = $this->height;
            $content = CHtml::tag('img', $options);                     
                }

                echo $content;
        }
}
?>