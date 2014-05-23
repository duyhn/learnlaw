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
	        <ol class="breadcrumb">
	          <li class="textTop">
	            <?php echo $this->Html->link(__('Diễn đàn'),'/Forums/')?>
	          </li>
	          <li class="active">
	           <?php echo $forum['Forum']['name']?>
	          </li>
	        </ol>
	        <ol class="breadcrumb">
	        	<li>
			    <span class="text-right">
			        <?php echo $this->Html->link(__('Tạo chủ đề'),array('action'=>'add'),array('class'=>'btn btn-primary'))?>
			    </span>
	        	</li>
	        </ol>
			</div>
 
			  <div class="col-lg-4">
			      <p style="font-weight:bold;">
			        <?php
			        /*echo $this->Paginator->counter(
			                'Hiển thị {:start} - {:end} / {:count}'
			        );*/
			        echo "Hiển thị:".$page."/".$numberrecord;
			        ?>
			      </p>
			  </div>

 
 
			<div class="row">
		        <table class="size">
		            <thead class="title">
		                 <tr >
		                            <th colspan=2 class="ttForum">Diễn đàn: <?php echo $forum['Forum']['name']?></th>
		                            <th>Tạo bởi</th>
		                            <th class="colgenner1">Ngày tạo</th>
		                            <th class="colgenner"></th>
		                            <th class="baicuoi">Bài cuối</th>
		                 </tr>
		            </thead>
		             
		            <tbody>
		                <?php 
		               
		                foreach ($topics as $topic): ?>
		                <tr>
		                    <td class="tdImg">
		                    	<?php echo $this->Html->image('image/topic3.png') ?>
		                    	
							</td>
		                    <td><span class="tieude1">
		                        <?php
		                        echo $this->Html->link('<h4>'.$topic['Topic']['name'].'</h4>',
		                                                array('controller'=>'topics','action'=>'view',$topic['Topic']['id']),
		                                               array('escape'=>false));
		                        ?>
		                        </span>
		                    </td>
		                    <td><?php
		                        echo $this->Html->link($topic['User']['username'],
		                                                array('controller'=>'users','action'=>'profile',$topic['User']['user_id']));
		                        ?>
		                    </td>
		                    <td><?php
		                            echo $this->Time->timeAgoInWords($topic['Topic']['created']);
		                        ?>
		                    </td>
		                    <td>Trả lời: 
		                       <?php
		                        echo count($topic['Post']);
		                       ?>
		                    </td>
		                    <td>
		                     <?php
		                       if(count($topic['Post'])>0) {
		                        $post = $topic['Post'][0];
		                        echo $this->Time->timeAgoInWords($post['created']);
		                        echo '<p><small>bởi</small>&nbsp;';
		                        echo $this->Html->link($topic['User']['username'],array('controller'=>'users',
		                                                                                        'action'=>'profile',
		                                                                                        $topic['User']['user_id'])).' </p>';
		                             
		                       }
		                       ?>
		                    </td>
		                </tr>
		                <?php endforeach;?>
		            </tbody>
		        </table>
	        <div id="paging" class="right">
	            <?php
	            //pagination($controller,$action,$idtype,$page,$pagebgin,$pageend,$numberrecord)
	            
	            echo $this->User->pagination("topics","index",$forum['Forum']['id'],$page,$pagebgin,$pageend,$numberrecord);
	                //echo $this->element('paginator');
	            ?>
	         </div>

		</div>
	</div>
	<div class="clear cach"></div>
           <div id='footer'><?php  
           		$data=$this->Common->general();
           		echo $data['footer'];
           		 ?></div>
</div>
