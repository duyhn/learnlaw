<?php
        echo $this->Html->meta('icon');
       	echo $this->Html->css('bootstrap.min.css');
        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
        echo $this->Common->create_heaeder();
       	echo $this->Common->script(array("forum.js"));
       	echo $this->Common->script("ckeditor/ckeditor.js");
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
        Chủ đề: <span class="tdeTop"><?php echo $topic['Topic']['name'];?></span>
        <hr/>
        <span class="nd"><?php echo $topic['Topic']['content'];?></span>
    </div>  
</div>
<div class="row">
	  <?php if(isset($msg)){
                    $css='<script type="text/javascript">
                    var txt = new String('.$msg.');
                     alert(txt);</script>';
                    	echo $css;
                    }
                    ?>
    <div class="col-lg-4">
     <span class="tieudechung"><?php echo __('Các bình luận');?></span>
        <p style="font-size: 12px;">
         <?php
			        /*echo $this->Paginator->counter(
			                'Hiển thị {:start} - {:end} / {:count}'
			        );*/
			        echo "Hiển thị:".$page."/".$numberrecord;
			?>
        </p>
    </div>
</div>
 
<div class="row">
    <div class="col-lg-12">
        <div class="size left">
                <?php
                foreach ($posts as $post) :
                ?>
                <div class="bdpost">
	                <div class="left titleDate" style="width:100%;padding:7px 0;border-radius:7px 7px 0 0;">
	                            <?php
	                                echo $this->Time->timeAgoInWords($post['Post']['created']);
	                            ?>
	                </div>
	                <div class="tdImg left">
				                    	<?php echo $this->Html->image('image/topic3.png') ?>
				    </div>
		            <div class="tdfisrt left">
	                            <?php
	                                echo $this->Html->link($post['User']['username'],
	                                                        array('controller'=>'users','action'=>'profile',$post['User']['user_id']));
	                            ?>     
	                            <p class="date">Ngày tham gia:
	                            <?php
	                            //chuyen doi ngay
							        $date = $post['User']['created'];
							        $d = getdate(strtotime($date));
							        $inngay = $d['mday'].'/'.$d['mon'].'/'.$d['year'];
	                                echo $inngay;
	                            ?>
	                            </p>           
	                        <?php $hash = md5($post['User']['email']);?>
	                 </div>
	                 <div class="left tdsecond">
		                 <div class="left" id="post_<?php echo $post['Post']['id']?>">
		                            <?php echo $post['Post']['content'];?>
		                 </div>
		                 <?php
		                 
		                 	if($this->Session->read('Userid')==$post['Post']['user_id']){
		                 	$message="'Bạn có muốn xóa?Y/N'";
		                 	$cont="'". $post['Post']['content']."'";
		                 $modify='<div class="right" style="width:100px;">	                 
		                 	<a  title="Xóa bài viết" ><form method="post" action="/luatvnam/posts/delete/'.$post['Post']['id'].'"><input class="icdelete_doc" id="btnXoaTopic" type="submit" onclick="return confirm('.$message.');" value="'.$post['Post']['id'].'" style="color:#fff;" /></form></a>
		                 	<a  title="Sửa bài viết" ><input class="icedit_doc" id="btnSuaTopic" type="submit" onclick="editPost(this,'.$post['Post']['id'].')" value="'.$post['Post']['id'].'" name="okEdit" style="color:#fff;"/></a>
		                  </div>';
		                  echo $modify;
		                  }
		                  ?>
		                  </div>
	             </div>
                <?php endforeach;?>
 
        </div>
        <div id="paging" class="right">
        
            <?php
            	//print_r($topic);
            	//pagination($controller,$action,$idtype,$page,$pagebgin,$pageend,$numberrecord)
            	echo $this->User->pagination("topics","view",$topic['Topic']['id'],null,$page,$pagebgin,$pageend,$numberrecord);
               // echo $this->element('paginator');
            ?>
        </div>
        <div class="clearfix"></div>
        <div class="well">
            <h4><?php echo __('Trả lời bài viết');?></h4>
            <?php echo $this->Form->create('Post',array('url'=>array('controller'=>'posts','action'=>'add'),
                                                         'inputDefaults'=>array('label'=>false)));?>
                <div class="form-group">
                    <?php echo $this->Form->textarea('content',array('class'=>'form-control','rows'=>5,'placeholder'=>'Bình luận bằng tiếng Việt có dấu, không vi phạm pháp luật, thuần phong mỹ tục, lịch sự. Trân trọng!'));
                    echo "<script type='text/javascript'>CKEDITOR.replace(PostContent); </script>";
                    ?>
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
           		echo $data['footer']
           		 ?></div>