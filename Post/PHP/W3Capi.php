<?php 
/**
 +---------------------------------------------------------------------
 * @Mail:425389019 <425389019@qq.com>
 +---------------------------------------------------------------------
 * w3cschool 发文和更新接口
 +---------------------------------------------------------------------
 * $Id: W3Capi.class.php

  
  发文章api地址：http://www.w3cschool.cn/api/hosting/post
  Web开发入门项目更新接口Auth = AuthID
  数据发布方式POST
  注意：该版本接口为测试版，发现问题及时反馈
*/

class W3Capi {
    var $url = "http://www.w3cschool.cn/api/hosting/post";
    var $post_data = array(
      'artid'   => "",           // 文章唯一ID (用于更新时 识别标记)
      'title'   => "",           // 文章标题
      'content' => "",           // 文章内容
      'status'  => "publish",    // 发布状态：publish发布，draft草稿，private个人隐私的
      'creator' => "425389019",  // 这里一般自动生成,发布人，保持默认，无需修改
      'pename'  => "help",       // 项目标示，保持默认，无需修改
      'kename'  => "",           // 文章标示（例如：/html/html-intro.html 的是：html-intro ）可空
      'fkename' => "",           // 所在目录的kename（例如：/html/html-intro.html 的是：html-intro ）可空
      'ktype'   => "kn",         // 文章类型，保持默认，无需修改
      'flags'   => "ue",         // 内容类型：md标示是markdown内容，ue标示富媒体内容
      'auth'    => "AUTH",       // 项目Auth，保持默认，无需修改
    );

    public function __construct(){

    }

    /**
     * 发文接口
     * $data 示例: array(
     *   'artid'  => '唯一ID',
     *   'kTitle' => '标题',
     *   'kContent'=> '文章内容'
     *   )
     */
    public function post($data){

        $post_data = array_merge($this->post_data,$data);
        if(empty($post_data['title']) || empty($post_data['content'])){
          return "文章标题和内容不能空";
        }
        
        $this->post_data = $post_data;
        return $this->curlpost();
    }


    /**
     * 更新接口
     */
    public function update($data){

        $post_data = array_merge($this->post_data,$data);

        if(empty($post_data['title']) || empty($post_data['content'])){
          return "文章标题和内容不能空";
        }

        if(empty($data['artid'])) {
          return "文章唯一ID不能为空,否则无法匹配!";
        }

        $this->post_data = $post_data;
        return $this->curlpost();
       
    }


    public function curlpost(){
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->post_data);

        $output = curl_exec($ch);
        curl_close($ch);

        return $output;
    }

}

