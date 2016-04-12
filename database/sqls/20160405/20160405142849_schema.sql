# create table `tiny`.`video`
drop table if exists `tiny`.`video`;
create table if not exists `tiny`.`video` (
   `id` int unsigned not null auto_increment primary key,
   `video_id` varchar(255) not null,
   `title` varchar(255) not null default '',
   `description` varchar(1000) not null default '',
   `cover_image` varchar(1000) not null default '',
   `detail_html` text not null,
   `playUrl` varchar(255) not null default '',
   `embedUrl` varchar(255) not null default '',
   `downloadUrl` varchar(255) not null default '',
   `type` enum('default',
   'other') not null default 'default',
   `state` enum('default',
   'other') not null default 'default',
   `manual_order` int not null default '0',
   `like_count` int unsigned not null default '0',
   `share_count` int unsigned not null default '0',
   `comment_count` int unsigned not null default '0',
   `favor_count` int unsigned not null default '0',
   `fake_like_count` int unsigned not null default '0',
   `fake_favor_count` int unsigned not null default '0',
   `fake_share_count` int unsigned not null default '0',
   `fake_comment_count` int unsigned not null default '0',
   `created_at` timestamp not null default current_timestamp,
   `updated_at` timestamp not null
) default character set utf8 collate utf8_unicode_ci;
alter table `tiny`.`video` add unique `tiny_video_video_id_unique`(`video_id`);

# create table `tiny`.`good`
drop table if exists `tiny`.`good`;
create table if not exists `tiny`.`good` (
   `id` int unsigned not null auto_increment primary key,
   `good_id` varchar(255) not null,
   `name` varchar(255) not null default '',
   `simple_name` varchar(255) not null default '',
   `full_name` varchar(255) not null default '',
   `pinyin` varchar(255) not null default '',
   `letter` varchar(255) not null default '',
   `fletter` varchar(255) not null default '',
   `brand_id` varchar(255) not null default '',
   `description` varchar(1000) not null default '',
   `detail_html` text not null,
   `cover_image` varchar(1000) not null default '',
   `preview_images` varchar(1000) not null default '',
   `detail_images` varchar(6000) not null default '',
   `post_images` varchar(1000) not null default '',
   `url` varchar(255) not null default '',
   `posts_ids` varchar(1000) not null default '',
   `price` double(8,
   2) not null default '0',
   `ori_price` double(8,
   2) not null default '0',
   `discount` double(8,
   2) not null default '0',
   `tags` varchar(1000) not null default '',
   `purchase_url` varchar(1000) not null default '',
   `rebate_url` varchar(1000) not null default '',
   `third_source` varchar(255) not null default '',
   `third_id` varchar(255) not null default '',
   `third_hash` varchar(255) not null default '',
   `purchase_type` enum('default',
   'other') not null default 'default',
   `type` enum('default',
   'other') not null default 'default',
   `state` enum('default',
   'other') not null default 'default',
   `manual_order` int not null default '0',
   `like_count` int unsigned not null default '0',
   `share_count` int unsigned not null default '0',
   `comment_count` int unsigned not null default '0',
   `favor_count` int unsigned not null default '0',
   `fake_like_count` int unsigned not null default '0',
   `fake_favor_count` int unsigned not null default '0',
   `fake_share_count` int unsigned not null default '0',
   `fake_comment_count` int unsigned not null default '0',
   `created_at` timestamp not null default current_timestamp,
   `updated_at` timestamp not null
) default character set utf8 collate utf8_unicode_ci;
alter table `tiny`.`good` add unique `tiny_good_good_id_unique`(`good_id`);

# create table `tiny`.`good_video`
drop table if exists `tiny`.`good_video`;
create table if not exists `tiny`.`good_video` (
   `id` int unsigned not null auto_increment primary key,
   `good_id` varchar(255) not null,
   `video_id` varchar(255) not null,
   `type` enum('default',
   'other') not null default 'default',
   `state` enum('default',
   'other') not null default 'default',
   `manual_order` int not null default '0',
   `created_at` timestamp not null default current_timestamp,
   `updated_at` timestamp not null
) default character set utf8 collate utf8_unicode_ci;
alter table `tiny`.`good_video` add unique `tiny_good_video_good_id_video_id_unique`(`good_id`, `video_id`);

# create table `tiny`.`user`
drop table if exists `tiny`.`user`;
create table if not exists `tiny`.`user` (
   `id` int unsigned not null auto_increment primary key,
   `user_id` varchar(255) not null,
   `username` varchar(255) null,
   `nickname` varchar(255) not null default '',
   `avatar` varchar(1000) not null default '',
   `sns_id` varchar(255) null,
   `email` varchar(255) null,
   `mobile` varchar(255) null,
   `qq` varchar(255) null,
   `password` varchar(128) null,
   `remember_token` varchar(100) null,
   `created_at` timestamp not null default current_timestamp,
   `updated_at` timestamp not null
) default character set utf8 collate utf8_unicode_ci;
alter table `tiny`.`user` add unique `tiny_user_user_id_unique`(`user_id`);
alter table `tiny`.`user` add unique `tiny_user_username_unique`(`username`);
alter table `tiny`.`user` add unique `tiny_user_email_unique`(`email`);
alter table `tiny`.`user` add unique `tiny_user_mobile_unique`(`mobile`);
alter table `tiny`.`user` add unique `tiny_user_qq_unique`(`qq`);

# create table `tiny`.`device`
drop table if exists `tiny`.`device`;
create table if not exists `tiny`.`device` (
   `id` int unsigned not null auto_increment primary key,
   `device_id` varchar(255) not null,
   `user_id` varchar(255) not null,
   `os` int not null default '0',
   `type` int not null default '0',
   `os_version` varchar(255) not null default '',
   `rom` varchar(255) not null default '',
   `rom_version` varchar(255) not null default '',
   `model` varchar(255) not null default '',
   `brand` varchar(255) not null default '',
   `manufacturer` varchar(255) not null default '',
   `push_token` varchar(255) not null default '',
   `created_at` timestamp not null default current_timestamp,
   `updated_at` timestamp not null
) default character set utf8 collate utf8_unicode_ci;
alter table `tiny`.`device` add unique `tiny_device_user_id_device_id_unique`(`user_id`, `device_id`);

# create table `tiny`.`sns`
drop table if exists `tiny`.`sns`;
create table if not exists `tiny`.`sns` (
   `id` int unsigned not null auto_increment primary key,
   `sns_id` varchar(255) not null,
   `user_id` varchar(255) null,
   `type` int not null default '0',
   `platform_id` varchar(255) not null default '',
   `nickname` varchar(255) not null default '',
   `avatar` varchar(255) not null default '',
   `created_at` timestamp not null default current_timestamp,
   `updated_at` timestamp not null
) default character set utf8 collate utf8_unicode_ci;
alter table `tiny`.`sns` add unique `tiny_sns_type_sns_id_unique`(`type`, `sns_id`);
alter table `tiny`.`sns` add index `tiny_sns_sns_id_index`(`sns_id`);
alter table `tiny`.`sns` add index `tiny_sns_user_id_sns_id_index`(`user_id`, `sns_id`);

# create table `tiny`.`video_favor`
drop table if exists `tiny`.`video_favor`;
create table if not exists `tiny`.`video_favor` (
   `id` int unsigned not null auto_increment primary key,
   `user_id` varchar(255) not null default '',
   `video_id` varchar(255) not null default '',
   `created_at` timestamp not null default current_timestamp,
   `updated_at` timestamp not null
) default character set utf8 collate utf8_unicode_ci;
alter table `tiny`.`video_favor` add unique `tiny_video_favor_user_id_video_id_unique`(`user_id`, `video_id`);

# create table `tiny`.`good_favor`
drop table if exists `tiny`.`good_favor`;
create table if not exists `tiny`.`good_favor` (
   `id` int unsigned not null auto_increment primary key,
   `user_id` varchar(255) not null default '',
   `good_id` varchar(255) not null default '',
   `created_at` timestamp not null default current_timestamp,
   `updated_at` timestamp not null
) default character set utf8 collate utf8_unicode_ci;
alter table `tiny`.`good_favor` add unique `tiny_good_favor_user_id_good_id_unique`(`user_id`, `good_id`);
