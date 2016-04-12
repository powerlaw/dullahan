drop table if exists "video";
create table if not exists "video" (
   "id" integer not null primary key autoincrement,
   "video_id" varchar not null,
   "title" varchar not null default '',
   "description" varchar not null default '',
   "cover_image" varchar not null default '',
   "detail_html" text not null,
   "play_url" varchar not null default '',
   "embed_url" varchar not null default '',
   "download_url" varchar not null default '',
   "type" varchar not null default 'default',
   "state" varchar not null default 'default',
   "manual_order" integer not null default '0',
   "like_count" integer not null default '0',
   "share_count" integer not null default '0',
   "comment_count" integer not null default '0',
   "favor_count" integer not null default '0',
   "fake_like_count" integer not null default '0',
   "fake_favor_count" integer not null default '0',
   "fake_share_count" integer not null default '0',
   "fake_comment_count" integer not null default '0',
   "created_at" datetime not null default current_timestamp,
   "updated_at" datetime not null
);
create unique index "tiny_video_video_id_unique" on "video" (
   "video_id"
);

drop table if exists "good";
create table if not exists "good" (
   "id" integer not null primary key autoincrement,
   "good_id" varchar not null,
   "name" varchar not null default '',
   "simple_name" varchar not null default '',
   "full_name" varchar not null default '',
   "pinyin" varchar not null default '',
   "letter" varchar not null default '',
   "fletter" varchar not null default '',
   "brand_id" varchar not null default '',
   "description" varchar not null default '',
   "detail_html" text not null,
   "cover_image" varchar not null default '',
   "preview_images" varchar not null default '',
   "detail_images" varchar not null default '',
   "post_images" varchar not null default '',
   "url" varchar not null default '',
   "posts_ids" varchar not null default '',
   "price" float not null default '0',
   "ori_price" float not null default '0',
   "discount" float not null default '0',
   "tags" varchar not null default '',
   "purchase_url" varchar not null default '',
   "rebate_url" varchar not null default '',
   "third_source" varchar not null default '',
   "third_id" varchar not null default '',
   "third_hash" varchar not null default '',
   "purchase_type" varchar not null default 'default',
   "type" varchar not null default 'default',
   "state" varchar not null default 'default',
   "manual_order" integer not null default '0',
   "like_count" integer not null default '0',
   "share_count" integer not null default '0',
   "comment_count" integer not null default '0',
   "favor_count" integer not null default '0',
   "fake_like_count" integer not null default '0',
   "fake_favor_count" integer not null default '0',
   "fake_share_count" integer not null default '0',
   "fake_comment_count" integer not null default '0',
   "created_at" datetime not null default current_timestamp,
   "updated_at" datetime not null
);
create unique index "tiny_good_good_id_unique" on "good" (
   "good_id"
);

drop table if exists "good_video";
create table if not exists "good_video" (
   "id" integer not null primary key autoincrement,
   "good_id" varchar not null,
   "video_id" varchar not null,
   "type" varchar not null default 'default',
   "state" varchar not null default 'default',
   "manual_order" integer not null default '0',
   "created_at" datetime not null default current_timestamp,
   "updated_at" datetime not null
);
create unique index "tiny_good_video_good_id_video_id_unique" on "good_video" (
   "good_id",
   "video_id"
);

drop table if exists "user";
create table if not exists "user" (
   "id" integer not null primary key autoincrement,
   "user_id" varchar not null,
   "username" varchar null,
   "nickname" varchar not null default '',
   "avatar" varchar not null default '',
   "sns_id" varchar null,
   "email" varchar null,
   "mobile" varchar null,
   "qq" varchar null,
   "password" varchar null,
   "remember_token" varchar null,
   "created_at" datetime not null default current_timestamp,
   "updated_at" datetime not null
);
create unique index "tiny_user_user_id_unique" on "user" (
   "user_id"
);
create unique index "tiny_user_username_unique" on "user" (
   "username"
);
create unique index "tiny_user_email_unique" on "user" (
   "email"
);
create unique index "tiny_user_mobile_unique" on "user" (
   "mobile"
);
create unique index "tiny_user_qq_unique" on "user" (
   "qq"
);

drop table if exists "device";
create table if not exists "device" (
   "id" integer not null primary key autoincrement,
   "device_id" varchar not null,
   "user_id" varchar not null,
   "os" integer not null default '0',
   "type" integer not null default '0',
   "os_version" varchar not null default '',
   "rom" varchar not null default '',
   "rom_version" varchar not null default '',
   "model" varchar not null default '',
   "brand" varchar not null default '',
   "manufacturer" varchar not null default '',
   "push_token" varchar not null default '',
   "created_at" datetime not null default current_timestamp,
   "updated_at" datetime not null
);
create unique index "tiny_device_user_id_device_id_unique" on "device" (
   "user_id",
   "device_id"
);

drop table if exists "sns";
create table if not exists "sns" (
   "id" integer not null primary key autoincrement,
   "sns_id" varchar not null,
   "user_id" varchar null,
   "union_id" varchar null,
   "type" integer not null default '0',
   "platform_id" varchar not null default '',
   "nickname" varchar not null default '',
   "avatar" varchar not null default '',
   "created_at" datetime not null default current_timestamp,
   "updated_at" datetime not null
);
create unique index "tiny_sns_type_sns_id_unique" on "sns" (
   "type",
   "sns_id"
);
create index "tiny_sns_sns_id_index" on "sns" (
   "sns_id"
);
create index "tiny_sns_user_id_sns_id_index" on "sns" (
   "user_id",
   "sns_id"
);

drop table if exists "video_favor";
create table if not exists "video_favor" (
   "id" integer not null primary key autoincrement,
   "user_id" varchar not null default '',
   "video_id" varchar not null default '',
   "created_at" datetime not null default current_timestamp,
   "updated_at" datetime not null
);
create unique index "tiny_video_favor_user_id_video_id_unique" on "video_favor" (
   "user_id",
   "video_id"
);

drop table if exists "good_favor";
create table if not exists "good_favor" (
   "id" integer not null primary key autoincrement,
   "user_id" varchar not null default '',
   "good_id" varchar not null default '',
   "created_at" datetime not null default current_timestamp,
   "updated_at" datetime not null
);
create unique index "tiny_good_favor_user_id_good_id_unique" on "good_favor" (
   "user_id",
   "good_id"
);
