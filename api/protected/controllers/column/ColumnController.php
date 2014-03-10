<?php
/**
 * 
 * @authors wujch 
 * @date    2014-03-06 16:19:57
 * @version $Id$
 */

class ColumnController extends Controller {
    public function actionGetColumnInfo(){
        $form = new ColumnForm();
        $form->loadAttributesFromRequest();
        if(!$form->validate()){
            return $this->jsonError(400,$form->getFirstError());
        }
        $columnModel = new  ColumnModel();
        $column = $columnModel->getColumnInfo($form->id);
        if(!$column){
            return $this->jsonError(401,$column->getFirstError());
        }
        $columnInfo  = $this->formatColumnInfo($column);
        return $this->jsonSuccess(200,'success',$columnInfo);
    }

    public function actionGetTopColumn(){
        $columnModel = new  ColumnModel();
        $columns = $columnModel->getChildrenColumns(0);
        $result = array();
        foreach($columns as $column){
            $result[] = $this->formatColumnInfo($column);
        }
        return $this->jsonSuccess(200,'success',$result);
    }

    public function actionGetChildrenColumn(){
        $form = new ColumnForm();
        $form->loadAttributesFromRequest();
        if(!$form->validate()){
            return $this->jsonError(400,$form->getFirstError());
        }
        $columnModel = new ColumnModel();
        $childrenColumn = $columnModel->getChildrenColumns($form->id);
        if(empty($childrenColumn)){
            return $this->jsonError(401,'column has not any children');
        }
        $result = array();
        foreach($childrenColumn as $childColumn){
               $columnInfo = $this->formatColumnInfo($childColumn);
               $result[] = $columnInfo; 
        }
        return $this->jsonSuccess(200,'success',$result);
    }

    public function actionGetColumnVideos(){
        $form = new ColumnForm('pagination');
        $form->loadAttributesFromRequest();
        if(!$form->validate()){
            return $this->jsonError(400,$form->getFirstError());
        }
        $columnModel = new ColumnModel();        
        $videos = $columnModel->getColumVideos($form->id,$form->page,$form->size);
    }

    protected function formatColumnInfo($column){
            if(is_array($column)){
                if(isset($column['parent_id'])) unset($column['parent_id']);
                if(isset($column['subscribers'])) unset($column['subscribers']);
                if(isset($column['column_content'])) unset($column['column_content']);
                if(isset($column['tags'])) unset($column['tags']);
                if(isset($column['type'])) unset($column['type']);
                if(isset($column['property'])) unset($column['property']);
                return $column;
            }elseif(is_object($column)){
                $columnInfo =  array(
                    'id' => $column->id,
                    'name' => $column->name,
                    'children_id' => $column->children_id,
                    'pic_url' => $column->pic_url,
                    'effective_time' => $column->effective_time,
                    'dead_time' => $column->dead_time,
                    'columninfo_timestamp' => $column->columninfo_timestamp,
                    'subcolumn_timestamp' => $column->subcolumn_timestamp,
                    'video_timestamp' => $column->video_timestamp,
                    'show_type' => $column->show_type,
                );
                return $columnInfo;
            }
            return false;
    }
        
}