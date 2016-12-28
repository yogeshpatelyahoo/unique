<?php

/**
 * Admin panel side bar menu view file
 */

?>

<div class="navbar-content">
    <!-- start: SIDEBAR -->
    <div class="main-navigation navbar-collapse collapse">
        <!-- start: MAIN NAVIGATION MENU -->
        <ul class="main-navigation-menu">
            
           <li <?php if($this->params['controller']=="category"){ ?>class="active"<?php }?>>
    
                <?php
                echo $this->Html->link('<i class="fa fa-briefcase"></i><span class="title"> Categories </span><i class="icon-arrow"></i><span class="selected"></span>','#', array('escape' => false));
                ?>
                <ul class="sub-menu" >
                    <li <?php if($this->params['controller']=="category" && $this->params['action']=="admin_index"){ ?>class="active"<?php }?>>
                       <?php echo $this->Html->link('<span class="title"> Category List </span>', array('controller' => 'categories', 'action' => 'index'), array('escape' => false));?>
                    </li>
                    <li <?php if($this->params['controller']=="webcasts" && $this->params['action']=="admin_add"){ ?>class="active"<?php }?>>
                       <?php echo $this->Html->link('<span class="title"> Add Category</span>', array('controller' => 'categories', 'action' => 'addCategory','admin'=>true), array('escape' => false));?>
                    </li>
                </ul>
            </li> 

          
            
            <li <?php if($this->params['controller']=="users" ){ ?>class="active"<?php }?>>
                <?php
                echo $this->Html->link('<i class="fa fa-group"></i><span class="title"> Users </span><i class="icon-arrow"></i><span class="selected"></span>', '#', array('escape' => false));               
                ?>
                <ul class="sub-menu" >
                    <li <?php if($this->params['controller']=="users" && $this->params['action']=="admin_index"){ ?>class="active"<?php }?>>
                       <?php echo $this->Html->link('<span class="title"> Users List </span>', array('controller' => 'users', 'action' => 'index'), array('escape' => false));?>
                    </li>
                    
                    <li <?php if($this->params['controller']=="users" && $this->params['action']=="admin_addUser"){ ?>class="active"<?php }?>>
                       <?php echo $this->Html->link('<span class="title"> Add User</span>', array('controller' => 'users', 'action' => 'addUser','admin'=>true), array('escape' => false));?>
                    </li>
                </ul>
            </li> 

           <li <?php if($this->params['controller']=="candidates"){ ?>class="active"<?php }?>>
    
                <?php
                echo $this->Html->link('<i class="fa fa-youtube-play"></i><span class="title"> Candidates </span><i class="icon-arrow"></i><span class="selected"></span>', '#', array('escape' => false));
                ?>
                <ul class="sub-menu" >
                    <li <?php if($this->params['controller']=="candidates" && $this->params['action']=="admin_index"){ ?>class="active"<?php }?>>
                       <?php echo $this->Html->link('<span class="title"> Candidates List </span>', array('controller' => 'candidates', 'action' => 'index'), array('escape' => false));?>
                    </li>
                    <li <?php if($this->params['controller']=="candidates" && $this->params['action']=="admin_addCandidate"){ ?>class="active"<?php }?>>
                       <?php echo $this->Html->link('<span class="title"> Add Candidate</span>', array('controller' => 'candidates', 'action' => 'addCandidate','admin'=>true), array('escape' => false));?>
                    </li>
                </ul>
            </li>
            
            <li <?php if($this->params['controller']=="companies"){ ?>class="active"<?php }?>>
    
                <?php
                echo $this->Html->link('<i class="fa fa-youtube-play"></i><span class="title"> Companies </span><i class="icon-arrow"></i><span class="selected"></span>', '#', array('escape' => false));
                ?>
                <ul class="sub-menu" >
                    <li <?php if($this->params['controller']=="companies" && $this->params['action']=="admin_index"){ ?>class="active"<?php }?>>
                       <?php echo $this->Html->link('<span class="title"> Companies List </span>', array('controller' => 'companies', 'action' => 'index'), array('escape' => false));?>
                    </li>
                    <li <?php if($this->params['controller']=="candidates" && $this->params['action']=="admin_addCandidate"){ ?>class="active"<?php }?>>
                       <?php echo $this->Html->link('<span class="title"> Add Company</span>', array('controller' => 'companies', 'action' => 'addCompany','admin'=>true), array('escape' => false));?>
                    </li>
                </ul>
            </li>
            
            <li <?php if($this->params['controller']=="assignments"){ ?>class="active"<?php }?>>
    
                <?php
                echo $this->Html->link('<i class="fa fa-youtube-play"></i><span class="title"> Company Assignment </span><i class="icon-arrow"></i><span class="selected"></span>', '#', array('escape' => false));
                ?>
                <ul class="sub-menu" >
                    <li <?php if($this->params['controller']=="assignments" && $this->params['action']=="admin_index"){ ?>class="active"<?php }?>>
                       <?php echo $this->Html->link('<span class="title"> Assignments List </span>', array('controller' => 'assignments', 'action' => 'index'), array('escape' => false));?>
                    </li>
                    <li <?php if($this->params['controller']=="assignments" && $this->params['action']=="admin_addCandidate"){ ?>class="active"<?php }?>>
                       <?php echo $this->Html->link('<span class="title"> Add Assignment</span>', array('controller' => 'assignments', 'action' => 'add','admin'=>true), array('escape' => false));?>
                    </li>
                </ul>
            </li>
          
            

        </ul>
        <!-- end: MAIN NAVIGATION MENU -->
    </div>
    <!-- end: SIDEBAR -->
</div>
