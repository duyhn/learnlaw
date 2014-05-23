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
            <li class="textTop">
                <?php echo $this->Html->link(__('Diễn đàn'),'/Forums/')?>
            </li>
             <li class="textTop">
                <?php echo $this->Html->link($forum['Forum']['name'],array('controller'=>'topics','action'=>'index',$forum['Forum']['id']))?>
            </li>
            <li class="active">Chủ đề
                <?php //echo $topic['Topic']['name'];?>
            </li>
        </ol>
        <ol class="breadcrumb text-right">
        	<li>
            <?php echo $this->Html->link(__('Tạo chủ đề'),array('action'=>'add'),
                                                            array('class'=>'btn btn-primary'))?>
 
            <?php echo $this->Html->link(__('Trả lời bài viết'),array('controller'=>'posts','action'=>'add',$topic['Topic']['id']),
                                                            array('class'=>'btn btn-primary'))?>
            </li>
        </ol>
    </div>
</div>
<div class="col-lg-12">
    <div class="contentToppic">       
        Chủ đề: <span class="nd"><?php echo $topic['Topic']['name'];?><span>
        <hr/>
        <span class="nd"><?php echo $topic['Topic']['content'];?></span>
    </div>  
</div>
<div class="row">
    <div class="col-lg-4">
        <p style="font-weight: bold;">
        <?php
                echo $this->Paginator->counter(
                        'Hiển thị {:start} - {:end} / {:count}'
                );
                ?>
        </p>
    </div>
</div>
 
<div class="row">
    <div class="col-lg-12">
        <table class="size">
            <tbody>
                <?php
                foreach ($posts as $post) :
                ?>
                <thead class="titleDate">
                    <tr>
                        <th colspan=3>
                            <?php
                                echo $this->Time->timeAgoInWords($post['Post']['created']);
                            ?>
                        </th>
  
                    </tr>
                  </thead>
                    <tr>
	                    <td class="tdImg">
			                    	<?php echo $this->Html->image('image/topic3.png') ?>
			                    	
								</td>
	                     <td class="tdfisrt">
                        <p>
                            <?php
                                echo $this->Html->link($post['User']['username'],
                                                        array('controller'=>'users','action'=>'profile',$post['User']['user_id']));
                            ?>
                        </p>
                        <?php $hash = md5($post['User']['email']);?>
                       
                    </td>
                    <td>
                        <p>
                            <?php echo $post['Post']['content'];?>
                        </p>
                    </td>
                    </tr>
                <?php endforeach;?>
            </tbody>
 
        </table>
        <div id="paging" class="right">
        
            <?php
            	//print_r($topic);
            	//pagination($controller,$action,$idtype,$page,$pagebgin,$pageend,$numberrecord)
            	echo $this->User->pagination("topics","view",$topic['Topic']['id'],$page,$pagebgin,$pageend,$numberrecord);
               // echo $this->element('paginator');
            ?>
        </div>
        <div class="clearfix"></div>
        <div class="well">
            <h4><?php echo __('Trả lời bài viết');?></h4>
            <?php echo $this->Form->create('Post',array('url'=>array('controller'=>'posts','action'=>'add'),
                                                         'inputDefaults'=>array('label'=>false)));?>
                <div class="form-group">
                    <?php echo $this->Form->textarea('content',array('class'=>'form-control','rows'=>5));?>
                </div>
                <?php echo $this->Form->hidden('topic_id',array('value'=>$topic['Topic']['id']));?>
                <?php echo $this->Form->hidden('forum_id',array('value'=>$forum['Forum']['id']));?>
                <?php echo $this->Form->submit(__('Gửi'),array('class'=>'btn btn-primary'))?>
            <?php echo $this->Form->end();?>
        </div>
    
	</div>
	</div>
</div>
<div class="clear cach"></div>
           <div id='footer'><?php  
           		$data=$this->Common->general();
           		echo $data['footer'];
           		 ?></div>