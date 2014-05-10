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
          <li class="active">
            <?php echo __('Tạo chủ đề mới');?>
          </li>
        </ol>
  </div>
</div>
 
<div class="row">  
  <div class="col-lg-12">
     
    <div class="well">
        <?php echo $this->Form->create('Topic',array('class'=>'form-horizontal','inputDefaults'=>array('label'=>false)));?>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Tiêu đề</label>
            <div class="col-sm-10">
               <?php echo $this->Form->input('name',array('class'=>'form-control'));?>
            </div>
          </div>
          <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">Diễn đàn</label>
            <div class="col-sm-10">
                      <?php echo $this->Form->input('forum_id',array('options'=>$forums, 'class'=>'form-control'));?>
            </div>
          </div>
         <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">Nội dung</label>
            <div class="col-sm-10">
                <?php echo $this->Form->textarea('content',array('class'=>'form-control','rows'=>5));?>
            </div>
          </div>
           
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <?php echo $this->Form->submit(__('Tạo chủ đề'),array('class'=>'btn btn-primary'))?>
            </div>
          </div>
        </form>
    </div>
         
</div>
</div> 
</div>
<div class="clear cach"></div>
           <div id='footer'><?php  
           		$data=$this->Common->general();
           		echo $data['footer'];
           		 ?></div>