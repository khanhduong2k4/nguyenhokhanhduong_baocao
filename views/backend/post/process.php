<?php
use App\Models\Post;
use App\Libraries\MyClass;
if(isset($_POST['THEM'])){
   $post=new Post();
   //lấy từ form
   $post->name = $_POST['name'];
   $post->slug = (strlen($_POST['slug'])>0) ? $_POST['slug'] : MyClass :: str_slug($_POST['name']);
   $post->description = $_POST['description'];
   $post->status = $_POST['status'];
   //xử lí upload file hình ảnh
   if(strlen($_FILES['image']['name'])>0){
      $target_dir = "../public/images/post/";
      $target_file = $target_dir . basename($_FILES["image"]["name"]);
      $extension = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
      if(in_array($extension,['jpg','jpeg','png'.'gif','webp'])){
         $filename= $post->slug . '.' . $extension;
         move_uploaded_file($_FILES['image']['tmp_name'],$target_dir . $filename);
         $post->image = $filename;
      }
   }
   //tự sinh ra
   $post->created_at = date('Y-m-d H:i:s');
   $post->created_by = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : 1 ;
   var_dump($post);
   //lưu vào CSDL
   //INSERT INTO ...
   $post->save();
  //chuyển hướng về index
   header("location:index.php?option=post");
}

if(isset($_POST['CAPNHAT'])){

   $id= $_POST['id'];
   $post=Post::find($id);
   if($post==NULL)
 {
    header("location:index.php?option=post");
 }
   //lấy từ form
   $post->name = $_POST['name'];
   $post->slug = (strlen($_POST['slug'])>0) ? $_POST['slug'] : MyClass :: str_slug($_POST['name']);
   $post->description = $_POST['description'];
   $post->status = $_POST['status'];
   //xử lí upload file hình ảnh
   if(strlen($_FILES['image']['name'])>0){
      //xóa hình cũ


      //thêm hình mới
      $target_dir = "../public/images/post/";
      $target_file = $target_dir . basename($_FILES["image"]["name"]);
      $extension = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
      if(in_array($extension,['jpg','jpeg','png'.'gif','webp'])){
         $filename= $post->slug . '.' . $extension;
         move_uploaded_file($_FILES['image']['tmp_name'],$target_dir . $filename);
         $post->image = $filename;
      }
   }
   //tự sinh ra
   $post->updated_at = date('Y-m-d H:i:s');
   $post->updated_by = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : 1 ;
   var_dump($post);
   //lưu vào CSDL
   //INSERT INTO ...
   $post->save();
  //chuyển hướng về index
   header("location:index.php?option=post");
}
