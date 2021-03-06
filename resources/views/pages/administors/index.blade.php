@extends('layouts.common')

@section('style')
<style>
.card ul{list-style:none;text-align:center}
.card ul li{display:inline-block;width:calc(100% / 4)}
.card ul li a{color:#333;text-decoration:none;transition:all .25s;text-align:center;display:inline-block;width:100%;padding-top:.5rem}
.card ul li a:hover{background:#333;color:#FFF;transform:scale(1.1)}
.card ul li a i{font-size:2rem}
.card ul li a span{font-size:.9rem}
@media screen and (max-width:600px){
  .card ul li{width:50%}
}
</style>
@endsection

<?php
$menus = [
  ['displayName' => 'ユーザーのレベルを変える', 'linkHref' => route('changeLevel'), 'linkIcon' => 'fas fa-layer-group'],
  ['displayName' => 'ユーザー登録', 'linkHref' => route('registerUser'), 'linkIcon' => 'fas fa-user-plus'],
  ['displayName' => 'ユーザー設定変更', 'linkHref' => route('userSetting'), 'linkIcon' => 'fas fa-user-cog'],
];
?>

@section('content')
<div class=card>
  <ul>
    <?php foreach($menus as $menu){
      echo "<li><a href='",$menu['linkHref'],"'><i class='",$menu['linkIcon'],"'></i><br /><span>",$menu['displayName'],"</span></a></li>";
    } ?>
  </ul>
</div>
@endsection
