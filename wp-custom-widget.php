<?php
/*
 *Plugin Name: My Custom Widget
 *Plugin Uri: http:htcindia.com 
 * Description: this plugin save input data
 * Version: 1.0
 * Author: Amit Kumar
 * Author Uri: https://htcindia.com
 * License: GPL2
 */

 if(!class_exists("MyCustomWidget"))
 {
     class MyCustomWidget extends WP_Widget
     {

        public function __construct()
        {
            parent::WP_Widget(false,"My Custom Widget");
        }

        public function form($instance)
        {
            if(!empty($instance))
            {
                $title = $instance['title'];
                $description = $instance['description'];
                $type = $instance['type'];
            }
            else
            {
                $title ='';
                $description = '';
                $type = '';

            }
        ?>
            <p>
                <label for="<?PHP echo $this->get_field_id('title'); ?>">Title</label>
                <input type="text" name="<?PHP echo $this->get_field_name('title'); ?>" id="<?PHP echo $this->get_field_id('title'); ?>" value="<?PHP echo $title; ?>"/>
            </p>
            <p>
                <label for="<?PHP echo $this->get_field_id('description'); ?>">Description</label>
                <textarea name="<?PHP echo $this->get_field_name('description'); ?>" id="<?PHP echo $this->get_field_id('description'); ?>"><?PHP echo $description; ?></textarea>
            </p>
            <p>
                <label for="<?PHP echo $this->get_field_id('type'); ?>">Type</label>
                <select id="<?PHP echo $this->get_field_id('type'); ?>" name="<?PHP echo $this->get_field_name('type'); ?>">

                    <option value="Select Type" disable>Select Type</option>
                        <?PHP
                            $arrdata = ["Java","PHP","C","Python"];

                            foreach($arrdata as $data)
                            {
                                $selected = "";
                                if($data == $type)
                                {
                                    $selected = "selected";
                                }
                                ?>
                                    <option value="<?PHP echo $data; ?>" <?PHP echo $selected; ?>><?PHP echo $data; ?></option>
                                <?PHP
                            }
                        ?>
                </select>
            </p>
           
        <?PHP
        }

        public function update($new_instance, $old_instance)
        {
            $instance = $old_instance;
            $instance['title'] = $new_instance['title'];
            $instance['description'] = $new_instance['description'];
            $instance['type'] = $new_instance['type'];

            return $instance;
        }

        public function widget($args, $instance)
        {
            extract($args);
            echo $before_widget;
            echo $before_title;
            echo $instance['title'];
            echo $after_title;
            echo $instance['description']."<br/>";
            echo $instance['type'];
            echo $after_widget;


        }
     }

     function register_my_widget()
     {
         register_widget("MyCustomWidget");
     }
     add_action("widgets_init","register_my_widget");

 }