<?php
        echo $this->Html->meta('icon');
       	echo $this->Html->css('bootstrap.min.css');
        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
        echo $this->Common->create_heaeder();
?>
<div id="wrapper">    
<?php echo $this->element('navigation');?>
<div id="mainpanel" class="left">
<div class="border containtopic">
<div class="row">
          <div class="col-lg-12">
            <ol class="breadcrumb">
                <li>
                    <?php echo $this->Html->link(__('Diễn đàn'),'/Forums/')?>
                </li>
                <li>
                    <?php echo $this->Html->link($forum['Forum']['name'],array('controller'=>'topics','action'=>'index',$forum['Forum']['id']))?>
                </li>
                <li>
                    <?php echo $this->Html->link($topic['Topic']['name'],array('controller'=>'topics','action'=>'view',$topic['Topic']['id']))?>
                </li>
                <li class="active">
                    <?php echo __('Trả lời bài viết');?>
                </li>
            </ol>
          </div>
</div>
 
<div class="row"> 
          <div class="col-lg-12">
             
            <div class="well">
                <?php echo $this->Form->create('Post',array('class'=>'form-horizontal','inputDefaults'=>array('label'=>false)));?>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Nội dung</label>
                    <div class="col-sm-10">
                        <?php echo $this->Form->textarea('content',array('class'=>'form-control','rows'=>8));?>
                    </div>
                  </div>
                   
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                       <?php echo $this->Form->submit(__('Gửi'),array('class'=>'btn btn-primary'))?>
                    </div>
                  </div>
                  <?php echo $this->Form->hidden('topic_id',array('value'=>$topic['Topic']['id']))?>
                  <?php $dt=$this->Session->read("Userid");
                   echo $this->Form->hidden('user_id',array('value'=>$dt))?>
                  <?php echo $this->Form->hidden('forum_id',array('value'=>$forum['Forum']['id']))?>
                <?php echo $this->Form->end();?>
            </div>
                 
          </div>
 </div>
</div> 
</div>
<div class="clear cach"></div>
           <div id='footer'><?php  
           		$data=$this->Common->general();
           		echo $data['footer'];
           		 ?></div>