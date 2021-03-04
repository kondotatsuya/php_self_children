-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost:8889
-- 生成日時: 2021 年 3 月 04 日 05:59
-- サーバのバージョン： 5.7.30
-- PHP のバージョン: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- データベース: `php_self`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `comment` varchar(1024) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `trouble_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `comments`
--

INSERT INTO `comments` (`id`, `comment`, `user_id`, `trouble_id`, `created_at`) VALUES
(40, '　投稿されてからしばらく経過した現在、状況は同じですか？\r\n旦那様のお仕事の関係で、ほどんど一人での子育てで不安だと思います。\r\n特に赤ちゃんの子育ては心身共に大変です。睡眠不足や疲労感がありますが、\r\nお母さんは頼りになる人がいない孤独を抱えると、その疲れが2倍にも3倍\r\nにも膨れあがります。サークルや公園で仲間を見つけ仲良くなることにも\r\nよけいな神経のすり減りがあり、めぐり逢いの運命的なものもあります。\r\n無理やり仲良くなったとしても、後々面倒なことにはならないかなど、心配\r\nもありますよね。赤ちゃんは一緒になってしゃべってはくれないので、二人\r\nなのに孤独が押し寄せます。しかし、今のあなたのこの時期の子育ては、\r\n後にとても美しい思い出となります。一日に5分でも10分でも、何も考えずに\r\nお子さんを見つめて微笑んであげてください。あなたにとって、二人で過ごす\r\n気もちの良い瞬間であり、「記憶に刻まれる幸せ」にきっとなります。\r\n\r\n　日常的なこと、危険回避、連絡、応援などは旦那様とゆっくりお話しされる\r\n機会を作ってください。そして、今は子育ての時です。生活や主婦としての\r\n完璧を尽くそうと思ってはいけません。どんな母親も未熟です。\r\n\r\n　赤ちゃんには、お母さんの愛情をしっかりと感じとれる能力があります。\r\nやさしいお子さんに育ててくださいね。\r\n', 4, 29, '2021-03-04 14:37:28'),
(41, 'コメントありがとうございます', 1, 29, '2021-03-04 14:48:09');

-- --------------------------------------------------------

--
-- テーブルの構造 `favorites`
--

CREATE TABLE `favorites` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `user_id` int(11) DEFAULT NULL COMMENT 'ユーザID',
  `fav_user_id` int(11) DEFAULT NULL COMMENT 'お気に入りユーザID',
  `created_at` datetime DEFAULT NULL COMMENT '作成日時'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `favorites`
--

INSERT INTO `favorites` (`id`, `user_id`, `fav_user_id`, `created_at`) VALUES
(149, 4, 7, '2021-03-01 16:53:17'),
(150, 1, 4, '2021-03-03 15:39:41'),
(152, 1, 9, '2021-03-03 16:28:32'),
(153, 1, 8, '2021-03-03 16:28:36'),
(157, 1, 7, '2021-03-04 11:42:27');

-- --------------------------------------------------------

--
-- テーブルの構造 `keeps`
--

CREATE TABLE `keeps` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `trouble_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `keeps`
--

INSERT INTO `keeps` (`id`, `user_id`, `trouble_id`, `created_at`) VALUES
(6, 8, 27, '2021-03-03 16:25:27'),
(8, 7, 26, '2021-03-03 23:09:22'),
(9, 1, 27, '2021-03-04 11:42:11'),
(10, 4, 29, '2021-03-04 14:37:05');

-- --------------------------------------------------------

--
-- テーブルの構造 `troubles`
--

CREATE TABLE `troubles` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `title` varchar(255) DEFAULT NULL COMMENT '相談タイトル',
  `body` varchar(512) DEFAULT NULL COMMENT '相談内容',
  `user_id` int(11) DEFAULT NULL COMMENT 'ユーザID',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '作成日時'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `troubles`
--

INSERT INTO `troubles` (`id`, `title`, `body`, `user_id`, `created_at`) VALUES
(24, 'aaa', 'aaaa', 2, '2021-02-24 14:59:46'),
(25, 'テスト投稿1', 'テスト1テスト1テスト1テスト1テスト1テスト1テスト1テスト1テスト1テスト1テスト1テスト1テスト1テスト1テスト1テスト1テスト1テスト1テスト1テスト1テスト1テスト1テスト1テスト1テスト1テスト1テスト1テスト1テスト1', 1, '2021-02-24 16:03:37'),
(28, '9歳娘 急にわがまま？不安定な感じになりました。', '9歳になる娘がいます。\r\n\r\n今までずっと良い子で育ってきました。\r\n\r\nここ最近急にわがままっぽくなってきたと言いますか。\r\n\r\n嘘も平気でつくようになってきました。\r\nまた、人間関係で悩みもあるようで学校に中々いきたがらず休みたがるようになりました。最近は一緒に別室登校しています。\r\n\r\n何か抱えているのかなと思うのですが、私には余裕な感じの態度で…本心が見えません。\r\n\r\nこの時期独特のものでしょうか。\r\nどう関わればよいのか悩みます。', 1, '2021-03-04 14:27:45'),
(29, '育児が辛い', 'Twitter\r\nFacebook\r\nはてブ\r\nPocket\r\nLine\r\n生後6ヵ月の子を育てています。\r\n自分が望んだ事とは言え、子育てがこんなに辛いとは…\r\n夫は週1休みのみの激務で毎日ワンオペです。\r\n夜泣きも始まりこの1ヵ月全く寝れず辛いです。\r\n\r\n周りの友達の子供は幼稚園児以上が多く、同じ月齢の人達と話したいなぁ。と思い児童館などに行っても2人目、3人目の人が多く、話しをしていても、「そんなものよー！大きくなったらもっと大変よ！」と笑い飛ばされます。\r\n確かにそうなんでしょうけど…\r\n来てるのも顔見知りの長く通われてるお母さん達ばかりで居ずらくなり通うのをやめました。\r\n\r\n家で子供とずっと2人は嫌だけど児童館などに行きたくない人は毎日どうしてますか？\r\n', 1, '2021-03-04 14:36:35');

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(32) DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `role` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`id`, `user_name`, `mail`, `password`, `img`, `role`, `created_at`, `update_at`) VALUES
(1, 'test0001', 'test@0001.com', '4da0743166e0d5d668e1cad72adcb320', 'profile_icon.png', 0, '2021-02-24 12:39:00', '2021-02-24 12:39:00'),
(3, '管理者', 'test@0000.com', 'fd8e1b2ec2f403c60d5085b62722b704', '', 1, '2021-02-24 12:45:51', '2021-02-24 12:45:51'),
(4, 'test0003', 'test@0003.com', '2065549d13766bb469f4a421f313dacf', '1111.jpg', 0, '2021-02-24 12:47:00', '2021-02-24 12:47:00'),
(6, 'test0004', 'test@0004.com', '78ca831243b030a81ba918684835667d', '2222.png', 0, '2021-02-24 17:43:16', '2021-02-24 17:43:16'),
(7, 'テスト005', 'test005@gmail.com', 'f41f6a9d0d340f63c1d68cca07401b0b', '3333.jpg', 0, '2021-02-25 23:12:36', '2021-02-25 23:12:36');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `keeps`
--
ALTER TABLE `keeps`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `troubles`
--
ALTER TABLE `troubles`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルのAUTO_INCREMENT
--

--
-- テーブルのAUTO_INCREMENT `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- テーブルのAUTO_INCREMENT `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=158;

--
-- テーブルのAUTO_INCREMENT `keeps`
--
ALTER TABLE `keeps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- テーブルのAUTO_INCREMENT `troubles`
--
ALTER TABLE `troubles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=30;

--
-- テーブルのAUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
