<?php
 require 'libs/functions.php';

 $name = isset( $_POST[ 'name' ] ) ? $_POST[ 'name' ] : NULL;
 $email = isset( $_POST[ 'email' ] ) ? $_POST[ 'email' ] : NULL;
 $message = isset( $_POST[ 'message' ] ) ? $_POST[ 'message' ] : NULL;
 $subject = isset( $_POST[ 'subject' ] ) ? $_POST[ 'subject' ] : NULL;

 if (isset($_POST['submitted'])) {

	 $_POST = checkInput( $_POST );

	 if(isset($_POST['name'])) {
		 $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
	 }

	 if(isset($_POST['email'])) {
		 $email = str_replace(array("\r", "\n", "%0a", "%0d"), '', $_POST['email']);
		 $email = filter_var($email, FILTER_VALIDATE_EMAIL);
	 }

	 if(isset($_POST['message'])) {
		 $message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);
	 }

	 if ($_SERVER['REQUEST_METHOD']==='POST') {

		 require 'libs/mailvars.php';

		 $mail_body = 'コンタクトページからのお問い合わせ' . "\n\n";
		 $mail_body .=  "お名前： " .h($name) . "\n";
		 $mail_body .=  "電話番号： " .h($phone) . "\n";
		 $mail_body .=  "Email： " . h($email) . "\n"  ;
		 $mail_body .=  "＜お問い合わせ内容＞" . "\n" . h($message);

		 //-------- sendmail
		 $mailTo = mb_encode_mimeheader(MAIL_TO_NAME) ."<" . MAIL_TO. ">";

		 $returnMail = MAIL_RETURN_PATH;

		 mb_language( 'ja' );
		 mb_internal_encoding( 'UTF-8' );


		 $header = "From: " . mb_encode_mimeheader($name) ."<" . $email. ">\n";
		 $header .= "Cc: " . mb_encode_mimeheader(MAIL_CC_NAME) ."<" . MAIL_CC.">\n";
		 // $header .= "Bcc: <" . MAIL_BCC.">";


		 if ( ini_get( 'safe_mode' ) ) {
			 $result = mb_send_mail( $mailTo, $subject, $mail_body, $header );
		 } else {
			 $result = mb_send_mail( $mailTo, $subject, $mail_body, $header, '-f' . $returnMail );
		 }


		 if ( $result ) {
			 $_POST = array();
			 $name = '';
			 $email = '';
			 $message = '';

			 $params = '?result='. $result;
			 if(isset($_SERVER['HTTP_X_FORWARDED_PROTO']) and $_SERVER['HTTP_X_FORWARDED_PROTO'] === "https") {
				 $_SERVER['HTTPS'] = 'on';
			 }
			 $url = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://').$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME'];
			 header('Location:' . $url . $params);
			 exit;
		 }
	 }
 }
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta property="og:url" content="" />
	<meta property="og:type" content="website">
	<meta property="og:title" content="" />
	<meta property="og:description" content="" />
	<meta property="og:site_name" content="" />
	<meta property="og:image" content="" />
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge" />
	<title></title>
	<link href="css/style.css" rel="stylesheet" />
	<link href="http://fonts.googleapis.com/earlyaccess/notosansjp.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@900&display=swap" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
	<header>
		<h1 class="site-title alphabet">Wakita Lab X-ART 2021</h1>
		<nav class="nav-titles alphabet">
			<ul>
				<li class="nav-title"><a href="#Archive" class="nav-link">Archive</a></li>
				<li class="nav-title"><a href="#Concept" class="nav-link">Concept</a></li>
				<li class="nav-title"><a href="#Artists" class="nav-link">Artists</a></li>
				<li class="nav-title"><a href="#Schedule" class="nav-link">Schedule</a></li>
				<li class="nav-title"><a href="#Access" class="nav-link">Access</a></li>
				<li class="nav-title"><a href="#curatorsNote" class="nav-link">Curator's note</a></li>
				<li class="nav-title"><a href="#Contact" class="nav-link">Contact</a></li>
			</ul>
		</nav>
	</header>

	<div class="main-visual"></div>

	<main>

		<h2 class="section-title alphabet" id="Archive">Archive</h2>
		<div class="archive-img">
			<div class="not-hidden-img"><a href="archives/archive.html"><img src="img/dummy.png"></a></div>
			<div class="not-hidden-img"><a href="archives/archive.html"><img src="img/dummy.png"></a></div>
			<div class="not-hidden-img"><a href="archives/archive.html"><img src="img/dummy.png"></a></div>
			<div class="not-hidden-img"><a href="archives/archive.html"><img src="img/dummy.png"></a></div>
			<!--非表示ここから-->
				<!-- <div class="hidden-img-flex"> -->
			<div class="hidden-img"><a href="archives/archive.html"><img src="img/dummy.png"></a></div>
			<div class="hidden-img"><a href="archives/archive.html"><img src="img/dummy.png"></a></div>
			<div class="hidden-img"><a href="archives/archive.html"><img src="img/dummy.png"></a></div>
			<div class="hidden-img"><a href="archives/archive.html"><img src="img/dummy.png"></a></div>
			<div class="hidden-img"><a href="archives/archive.html"><img src="img/dummy.png"></a></div>
			<div class="hidden-img"><a href="archives/archive.html"><img src="img/dummy.png"></a></div>
				<!-- </div> -->
			<!--ここまで-->
		</div>
		</a>
		<div class="button-wrapper"><button id="view-more-img" class="view-more view-less" type="button">
				<p class="text-more"></p>
				<p class="text-less"></p></button></div>
		</div>
		</div>

		<h2 class="section-title alphabet" id="Concept">Concept</h2>
		<p class="description">もはや、インターネットは古臭く、連帯や協働、オンラインや遠隔といった言葉はミノタウロスの彫刻のようになってしまった。誰もが同時的に接続し、関係性のあわいを常に更新し続ける流動的な彫刻としての現在《いま・ここ》は、分断によって再構築されている。もはや、我々には同時接続しか残されていないのか。
				<br><br>悲劇の後には、連帯が生まれる。ちょうど、フィブリノーゲンがトロンビンによって凝固血栓を作り、傷口を塞ぐようなやり方で、それぞれのセクターが引力を持ちながら回転しつつ引き合う。かつてあった強烈な境界線〈罹災者・傍観者・感染者・非感染者〉は過去の遺物になり、新しい日常を出迎える。
				<br><br>すなはちは、人みなあぢきなき事をのべて、いさゝか心のにごりもうすらぐとみえしかど、月日かさなり、年へにしのちは、ことばにかけていひいづる人だになし。（――鴨長明、方丈記による）</p>

		<h2 class="section-title alphabet" id="Artists">Artists</h2>
		<p class="description">植田理紗子／小川楽生／工藤望／柴原佳範／鈴木一生／武谷梨紗子／ホシバナ（酒井瑛一、勝沼千秋）／本堂莉理／松橋百葉／眞鍋創人／諸藤勇太／山下光</p>

		<h2 class="section-title alphabet" id="Schedule">Schedule</h2>
		<p class="description">2021年9月24日から10月6日までのうち、4日ほどの展示を想定する。</p>

		<h2 class="section-title  alphabet" id="Access">Access</h2>
		<p class="description">慶應義塾大学 湘南藤沢キャンパス ゼータ館　〒252-0882 神奈川県藤沢市遠藤5322</p>
		<div class="gmap">
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d725.3058142190275!2d139.42844755128576!3d35.38658129150853!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x601853ea5f37a509%3A0xb3a89351b539a82a!2z44CSMjUyLTA4MTYg56We5aWI5bed55yM6Jek5rKi5biC6YGg6JekIM6WKOOCvOODvOOCvynppKg!5e0!3m2!1sja!2sjp!4v1630743467267!5m2!1sja!2sjp" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
		</div>

		<h2 class="section-title  alphabet" id="curatorsNote">Curator's Note</h2>
		<a href="curators/curatorsNote.html"><p class="description child-hover">タイトルタイトルタイトルタイトルタイトルタイトルタイトルタイトルタイトル</p>
		<p class="date child-hover">2021.08.31</p>
		<hr class="child-hover"></a>
		<a href="curators/curatorsNote.html"><p class="description child-hover">タイトルタイトルタイトルタイトルタイトルタイトルタイトルタイトルタイトル</p>
		<p class="date child-hover">2021.08.31</p>
		<hr class="child-hover"></a>
		<a href="curators/curatorsNote.html"><p class="description child-hover">タイトルタイトルタイトルタイトルタイトルタイトルタイトルタイトルタイトル</p>
		<p class="date child-hover">2021.08.31</p>
		<hr class="child-hover"></a>
		<div class="hidden-note">
			<a href="curators/curatorsNote.html"><p class="description child-hover">タイトルタイトルタイトルタイトルタイトルタイトルタイトルタイトルタイトル</p>
			<p class="date child-hover">2021.08.31</p>
			<hr class="child-hover"></a>
			<a href="curators/curatorsNote.html"><p class="description child-hover">タイトルタイトルタイトルタイトルタイトルタイトルタイトルタイトルタイトル</p>
			<p class="date child-hover">2021.08.31</p>
			<hr class="child-hover"></a>
		</div>
		<div class="button-wrapper"><button id="view-more-note" class="view-more" type="button">
				<p class="text-more"></p>
				<p class="text-less"></p>
				< /button>
		</div>

		<h2 class="section-title alphabet" id="Contact">Contact</h2>
		<p class="description-20">お名前*</p>
		<input type="text" name="name" class="form-text" />
		<p class="description-20">電話番号*</p>
		<input type="tel" name="phone" class="form-text" />
		<p class="description-20">メールアドレス*</p>
		<input type="email" name="email" class="form-text" />
		<p class="description-20">メールアドレス再入力*</p>
		<input type="email" name="email" class="form-text" />
		<p class="description-20">内容*</p>
		<textarea name="message" class="form-textarea"></textarea>
	</main>
	<footer class="text-center">
		<p class="footer alphabet">Copyright &copy; 2021 wakitaLabX-ART, All Rights Reserved.</p>
	</footer>
	<script src="js/script.js"></script>
</body>
</html>
