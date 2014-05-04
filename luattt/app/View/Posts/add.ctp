<?php
        echo $this->Html->meta('icon');
 
        echo $this->Html->css('bootstrap.min.css');
 
        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
    ?>
<div class="row">
          <div class="col-lg-12">
            <ol class="breadcrumb">
                <li>
                    <?php echo $this->Html->link(__('Forum'),'/')?>
                </li>
                <li>
                    <?php echo $this->Html->link($forum['Forum']['name'],array('controller'=>'topics','action'=>'index',$forum['Forum']['id']))?>
                </li>
                <li>
                    <?php echo $this->Html->link($topic['Topic']['name'],array('controller'=>'topics','action'=>'view',$topic['Topic']['id']))?>
                </li>
                <li class="active">
                    <?php echo __('Post Reply');?>
                </li>
            </ol>
          </div>
</div>
 
<div class="row"> 
          <div class="col-lg-12">
            <p class="lead"><?php echo __('Post Reply');?></p>
             
            <div class="well">
                <?php echo $this->Form->create('Post',array('class'=>'form-horizontal','inputDefaults'=>array('label'=>false)));?>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Content</label>
                    <div class="col-sm-10">
                        <?php echo $this->Form->textarea('content',array('class'=>'form-control','rows'=>8));?>
                    </div>
                  </div>
                   
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                       <?php echo $this->Form->submit(__('Post Reply'),array('class'=>'btn btn-primary'))?>
                    </div>
                  </div>
                  <?php echo $this->Form->hidden('topic_id',array('value'=>$topic['Topic']['id']))?>
                  <?php echo $this->Form->hidden('user_id',array('value'=>$this->Session->read("Userid")[0]['Users']['user_id']))?>
                  <?php echo $this->Form->hidden('forum_id',array('value'=>$forum['Forum']['id']))?>
                <?php echo $this->Form->end();?>
            </div>
                 
          </div>
 </div>
