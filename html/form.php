<?php session_start(); ?>
<!doctype html>
<html lang="cs-CZ">
<head>
	<meta charset="UTF-8">
	<title>Žádost o úvěr</title>

	<link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'><!-- http://www.google.com/fonts#UsePlace:use/Collection:PT+Sans:400,700 -->
	<link rel="stylesheet" href="@@abspath/css/layout.css"/>
	<link rel="stylesheet" href="@@abspath/css/lightbox.css"/>

	<script type="text/javascript" src="@@abspath/js/modernizr.js"></script>
</head>
<body>

<?php
//input validate
$error = false;

if( isset( $_POST['submit'] ) ) {

	if( empty( $_POST['vyse_uveru'] ) ) {
		$error[] = 'Musíte zvolit výši úvěru.';
	}

	if( empty( $_POST['vyse_platby_v_mesicich'] ) ) {
		$error[] = 'Musíte zvolit dobu trvání.';
	}

	if( empty( $_POST['jmeno'] ) ) {
		$error[] = 'Musíte vyplnit jméno.';
	}

	if( empty( $_POST['prijmeni'] ) ) {
		$error[] = 'Musíte vyplnit příjmení.';
	}

	if( empty( $_POST['ulice'] ) ) {
		$error[] = 'Musíte vyplnit ulici.';
	}

	if( empty( $_POST['cp'] ) ) {
		$error[] = 'Musíte vyplnit číslo popisné.';
	}

	if( empty( $_POST['mesto'] ) ) {
		$error[] = 'Musíte vyplnit město.';
	}

	if( empty( $_POST['psc'] ) ) {
		$error[] = 'Musíte vyplnit PSČ.';
	}

	if( empty( $_POST['telefon'] ) ) {
		$error[] = 'Musíte vyplnit telefon.';
	}

	if( empty( $_POST['email'] ) ) {
		$error[] = 'Musíte vyplnit e-mail.';
	}

	if( empty( $_POST['zastava_ulice'] ) ) {
		$error[] = 'Musíte vyplnit ulici.';
	}

	if( empty( $_POST['zastava_cp'] ) ) {
		$error[] = 'Musíte vyplnit číslo popisné.';
	}

	if( empty( $_POST['zastava_psc'] ) ) {
		$error[] = 'Musíte vyplnit PSČ.';
	}

	if( empty( $_POST['zastava_mesto'] ) ) {
		$error[] = 'Musíte vyplnit město.';
	}

	if( empty( $_POST['druh_nemovitosti'] ) ) {
		$error[] = 'Musíte vyplnit druh nemovitosti.';
	}

	if( empty( $_POST['predpokladana_hodnota'] ) ) {
		$error[] = 'Musíte vyplnit předpokládanou hodnotu.';
	}


	if(  strtolower($_POST['captcha']) != strtolower($_SESSION['captcha']['code']) ) {
		$error[] = 'Musíte vyplnit správný ověřovací kód.';
	}

}
?>

<h1>Žádost o úvěr</h1>
<section class="calculator">
	<form id="calculator" target="lightbox_form" enctype="multipart/form-data" method="post">
		<?php if( !isset( $_POST['submit'] ) || $error != false ) :
			include("captcha/simple-php-captcha.php");
			$_SESSION['captcha'] = simple_php_captcha();
			$vyse_uveru = ( !empty( $_POST['vyse_uveru'] ) ) ? $_POST['vyse_uveru'] : 250000;
			$vyse_platby_v_mesicich = ( !empty( $_POST['vyse_platby_v_mesicich'] ) ) ? $_POST['vyse_platby_v_mesicich'] : 20;

			?>
			<div class="left_column">
				<label class="select">
					Výše úvěru:
					<div class="style_wrap">
						<select name="vyse_uveru">
							<option value="100000"<?php if( $vyse_uveru == 100000 ): ?> selected="selected"<?php endif; ?>>100.000 Kč</option>
							<option value="150000"<?php if( $vyse_uveru == 150000 ): ?> selected="selected"<?php endif; ?>>150.000 Kč</option>
							<option value="200000"<?php if( $vyse_uveru == 200000 ): ?> selected="selected"<?php endif; ?>>200.000 Kč</option>
							<option value="250000"<?php if( $vyse_uveru == 250000 ): ?> selected="selected"<?php endif; ?>>250.000 Kč</option>
							<option value="300000"<?php if( $vyse_uveru == 300000 ): ?> selected="selected"<?php endif; ?>>300.000 Kč</option>
							<option value="350000"<?php if( $vyse_uveru == 350000 ): ?> selected="selected"<?php endif; ?>>350.000 Kč</option>
							<option value="400000"<?php if( $vyse_uveru == 400000 ): ?> selected="selected"<?php endif; ?>>400.000 Kč</option>
							<option value="450000"<?php if( $vyse_uveru == 450000 ): ?> selected="selected"<?php endif; ?>>450.000 Kč</option>
							<option value="500000"<?php if( $vyse_uveru == 500000 ): ?> selected="selected"<?php endif; ?>>500.000 Kč</option>
							<option value="600000"<?php if( $vyse_uveru == 600000 ): ?> selected="selected"<?php endif; ?>>600.000 Kč</option>
							<option value="700000"<?php if( $vyse_uveru == 700000 ): ?> selected="selected"<?php endif; ?>>700.000 Kč</option>
							<option value="800000"<?php if( $vyse_uveru == 800000 ): ?> selected="selected"<?php endif; ?>>800.000 Kč</option>
							<option value="900000"<?php if( $vyse_uveru == 900000 ): ?> selected="selected"<?php endif; ?>>900.000 Kč</option>
							<option value="1000000"<?php if( $vyse_uveru == 1000000 ): ?> selected="selected"<?php endif; ?>>1.000.000 Kč</option>
							<option value="1100000"<?php if( $vyse_uveru == 1100000 ): ?> selected="selected"<?php endif; ?>>1.100.000 Kč</option>
							<option value="1200000"<?php if( $vyse_uveru == 1200000 ): ?> selected="selected"<?php endif; ?>>1.200.000 Kč</option>
							<option value="1300000"<?php if( $vyse_uveru == 1300000 ): ?> selected="selected"<?php endif; ?>>1.300.000 Kč</option>
							<option value="1400000"<?php if( $vyse_uveru == 1400000 ): ?> selected="selected"<?php endif; ?>>1.400.000 Kč</option>
							<option value="1500000"<?php if( $vyse_uveru == 1500000 ): ?> selected="selected"<?php endif; ?>>1.500.000 Kč</option>
							<option value="1600000"<?php if( $vyse_uveru == 1600000 ): ?> selected="selected"<?php endif; ?>>1.600.000 Kč</option>
							<option value="1700000"<?php if( $vyse_uveru == 1700000 ): ?> selected="selected"<?php endif; ?>>1.700.000 Kč</option>
							<option value="1800000"<?php if( $vyse_uveru == 1800000 ): ?> selected="selected"<?php endif; ?>>1.800.000 Kč</option>
							<option value="1900000"<?php if( $vyse_uveru == 1900000 ): ?> selected="selected"<?php endif; ?>>1.900.000 Kč</option>
							<option value="2000000"<?php if( $vyse_uveru == 2000000 ): ?> selected="selected"<?php endif; ?>>2.000.000 Kč</option>
							<option value="2100000"<?php if( $vyse_uveru == 2100000 ): ?> selected="selected"<?php endif; ?>>2.100.000 Kč</option>
							<option value="2200000"<?php if( $vyse_uveru == 2200000 ): ?> selected="selected"<?php endif; ?>>2.200.000 Kč</option>
							<option value="2300000"<?php if( $vyse_uveru == 2300000 ): ?> selected="selected"<?php endif; ?>>2.300.000 Kč</option>
							<option value="2400000"<?php if( $vyse_uveru == 2400000 ): ?> selected="selected"<?php endif; ?>>2.400.000 Kč</option>
							<option value="2500000"<?php if( $vyse_uveru == 2500000 ): ?> selected="selected"<?php endif; ?>>2.500.000 Kč</option>
							<option value="2600000"<?php if( $vyse_uveru == 2600000 ): ?> selected="selected"<?php endif; ?>>2.600.000 Kč</option>
							<option value="2700000"<?php if( $vyse_uveru == 2700000 ): ?> selected="selected"<?php endif; ?>>2.700.000 Kč</option>
							<option value="2800000"<?php if( $vyse_uveru == 2800000 ): ?> selected="selected"<?php endif; ?>>2.800.000 Kč</option>
							<option value="2900000"<?php if( $vyse_uveru == 2900000 ): ?> selected="selected"<?php endif; ?>>2.900.000 Kč</option>
							<option value="3000000"<?php if( $vyse_uveru == 3000000 ): ?> selected="selected"<?php endif; ?>>3.000.000 Kč</option>
						</select>
					</div>
				</label>
				<label class="select">
					Doba splácení:
					<div class="style_wrap">
						<select name="vyse_platby_v_mesicich">
							<option value="1"<?php if( $vyse_platby_v_mesicich == 1 ): ?> selected="selected"<?php endif; ?>>1 rok</option>
							<option value="2"<?php if( $vyse_platby_v_mesicich == 2 ): ?> selected="selected"<?php endif; ?>>2 roky</option>
							<option value="3"<?php if( $vyse_platby_v_mesicich == 3 ): ?> selected="selected"<?php endif; ?>>3 roky</option>
							<option value="4"<?php if( $vyse_platby_v_mesicich == 4 ): ?> selected="selected"<?php endif; ?>>4 roky</option>
							<option value="5"<?php if( $vyse_platby_v_mesicich == 5 ): ?> selected="selected"<?php endif; ?>>5 let</option>
							<option value="6"<?php if( $vyse_platby_v_mesicich == 6 ): ?> selected="selected"<?php endif; ?>>6 let</option>
							<option value="7"<?php if( $vyse_platby_v_mesicich == 7 ): ?> selected="selected"<?php endif; ?>>7 let</option>
							<option value="8"<?php if( $vyse_platby_v_mesicich == 8 ): ?> selected="selected"<?php endif; ?>>8 let</option>
							<option value="9"<?php if( $vyse_platby_v_mesicich == 9 ): ?> selected="selected"<?php endif; ?>>9 let</option>
							<option value="10"<?php if( $vyse_platby_v_mesicich == 10 ): ?> selected="selected"<?php endif; ?>>10 let</option>
							<option value="11"<?php if( $vyse_platby_v_mesicich == 11 ): ?> selected="selected"<?php endif; ?>>11 let</option>
							<option value="12"<?php if( $vyse_platby_v_mesicich == 12 ): ?> selected="selected"<?php endif; ?>>12 let</option>
							<option value="13"<?php if( $vyse_platby_v_mesicich == 13 ): ?> selected="selected"<?php endif; ?>>13 let</option>
							<option value="14"<?php if( $vyse_platby_v_mesicich == 14 ): ?> selected="selected"<?php endif; ?>>14 let</option>
							<option value="15"<?php if( $vyse_platby_v_mesicich == 15 ): ?> selected="selected"<?php endif; ?>>15 let</option>
							<option value="16"<?php if( $vyse_platby_v_mesicich == 16 ): ?> selected="selected"<?php endif; ?>>16 let</option>
							<option value="17"<?php if( $vyse_platby_v_mesicich == 17 ): ?> selected="selected"<?php endif; ?>>17 let</option>
							<option value="18"<?php if( $vyse_platby_v_mesicich == 18 ): ?> selected="selected"<?php endif; ?>>18 let</option>
							<option value="19"<?php if( $vyse_platby_v_mesicich == 19 ): ?> selected="selected"<?php endif; ?>>19 let</option>
							<option value="20"<?php if( $vyse_platby_v_mesicich == 20 ): ?> selected="selected"<?php endif; ?>>20 let</option>
						</select>
					</div>
				</label>
				<div class="splatka">
					Splátka:
					<div class="box">
						<strong><span id="calculator_splatka"><?php if( isset( $_POST['splatka'] ) ) { echo $_POST['splatka']; } else { echo '2 578,77'; } ?></span> Kč</strong>
					</div>
				</div>

				<input type="hidden" name="splatka" id="calc_hidden_splatka" value="<?php if( isset( $_POST['splatka'] ) ) { echo $_POST['splatka']; } else { echo '2 578,77'; } ?>"/>
				<input type="hidden" name="rpsn" id="calc_hidden_rpsn" value="<?php if( isset( $_POST['rpsn'] ) ) { echo $_POST['rpsn']; } else { echo '12,44'; } ?>" />

				<label>
					Jméno:
					<input type="text" name="jmeno" value="<?php if( isset( $_POST['jmeno'] ) ) echo $_POST['jmeno']; ?>" required="required"/>
				</label>
				<label>
					Příjmení:
					<input type="text" name="prijmeni" value="<?php if( isset( $_POST['prijmeni'] ) ) echo $_POST['prijmeni']; ?>" required="required"/>
				</label>

				<div class="columns_float">
					<label>
						Ulice:
						<input type="text" name="ulice" value="<?php if( isset( $_POST['ulice'] ) ) echo $_POST['ulice']; ?>" required="required" />
					</label>
					<label>
						Č.p.:
						<input type="text" name="cp" value="<?php if( isset( $_POST['cp'] ) ) echo $_POST['cp']; ?>" required="required" />
					</label>
				</div>

				<div class="columns_float right">
					<label>
						PSČ:
						<input type="text" name="psc" value="<?php if( isset( $_POST['psc'] ) ) echo $_POST['psc']; ?>" required="required" />
					</label>
					<label>
						Obec:
						<input type="text" name="mesto" value="<?php if( isset( $_POST['mesto'] ) ) echo $_POST['mesto']; ?>" required="required" />
					</label>
				</div>

				<label>
					Telefon:
					<input type="text" name="telefon" value="<?php if( isset( $_POST['telefon'] ) ) echo $_POST['telefon']; ?>" required="required" />
				</label>

				<label>
					E-mail:
					<input type="text" name="email" value="<?php if( isset( $_POST['email'] ) ) echo $_POST['email']; ?>" required="required" />
				</label>

				<label>
					Poznámka:
					<textarea name="poznamka" cols="30" rows="10"><?php if( isset( $_POST['poznamka'] ) ) echo $_POST['poznamka']; ?></textarea>
				</label>

				<div class="checkbox">
					<input id="check_osobni" type="checkbox" data-required-checkbox="true" data-osobni-udaje="true" name="checkbox" <?php if( isset( $_POST['checkbox'] ) && $_POST['checkbox'] == 'on' ) : ?>checked="checked" <?php endif; ?>/>
					<label for="check_osobni"><a href="@@abspath/zpracovani-udaju-popup.html" target="_blank" class="open_terms">Souhlasím se zpracováním osobních údajů</a></label>
				</div>

			</div>

			<div class="right_column">
				<div class="heading">Údaje o nemovitosti, která bude předmětem zástavy:</div>

				<div class="columns_float">
					<label>
						Ulice:
						<input type="text" name="zastava_ulice" value="<?php if( isset( $_POST['zastava_ulice'] ) ) echo $_POST['zastava_ulice']; ?>" required="required" />
					</label>
					<label>
						Č.p.:
						<input type="text" name="zastava_cp" value="<?php if( isset( $_POST['zastava_cp'] ) ) echo $_POST['zastava_cp']; ?>" required="required" />
					</label>
				</div>

				<div class="columns_float right">
					<label>
						PSČ:
						<input type="text" name="zastava_psc" value="<?php if( isset( $_POST['zastava_psc'] ) ) echo $_POST['zastava_psc']; ?>" required="required" />
					</label>
					<label>
						Obec:
						<input type="text" name="zastava_mesto" value="<?php if( isset( $_POST['zastava_mesto'] ) ) echo $_POST['zastava_mesto']; ?>" required="required" />
					</label>
				</div>

				<label class="select">
					Druh nemovitosti:
					<div class="style_wrap">
						<select name="druh_nemovitosti">
							<?php $druh_nemovitosti = ( isset( $_POST['druh_nemovitosti'] ) ) ? $_POST['druh_nemovitosti'] : false; ?>
							<option value="Rodinný dům" <?php if( $druh_nemovitosti == 'Rodinný dům' ) : ?>selected="selected"<?php endif; ?> >Rodinný dům</option>
							<option value="Byt" <?php if( $druh_nemovitosti == 'Byt' ) : ?>selected="selected"<?php endif; ?> >Byt</option>
							<option value="Družstevní byt" <?php if( $druh_nemovitosti == 'Družstevní byt' ) : ?>selected="selected"<?php endif; ?> >Družstevní byt</option>
							<option value="Pozemek" <?php if( $druh_nemovitosti == 'Pozemek' ) : ?>selected="selected"<?php endif; ?> >Pozemek</option>
							<option value="Komerční objekt" <?php if( $druh_nemovitosti == 'Komerční objekt' ) : ?>selected="selected"<?php endif; ?> >Komerční objekt</option>
							<option value="Chata" <?php if( $druh_nemovitosti == 'Chata' ) : ?>selected="selected"<?php endif; ?> >Chata</option>
							<option value="Jiná" <?php if( $druh_nemovitosti == 'Jiná' ) : ?>selected="selected"<?php endif; ?> >Jiná</option>
						</select>
					</div>
				</label>

				<label>
					Předpokládaná hodnota nemovitosti:
					<input type="text" name="predpokladana_hodnota"  value="<?php if( isset( $_POST['predpokladana_hodnota'] ) ) echo $_POST['predpokladana_hodnota']; ?>"  required="required" />
				</label>

				<label class="captcha">
					Opište kód z obrázku:
					<input type="text" name="captcha"  required="required" />
				</label>

				<img class="captcha" src="<?php echo $_SESSION['captcha']['image_src']; ?>" alt=""/>

				<div class="checkbox">
					<input type="checkbox" name="jsem_vlastnik" id="jsem_vlastnik" <?php if( isset( $_POST['jsem_vlastnik'] ) && $_POST['jsem_vlastnik'] == 'on' ) : ?>checked="checked" <?php endif; ?> />
					<label for="jsem_vlastnik">Jsem vlastník nemovitosti</label>
				</div>

				<div class="checkbox">
					<input type="checkbox" name="exekuce" id="exekuce" <?php if( isset( $_POST['exekuce'] ) && $_POST['exekuce'] == 'on' ) : ?>checked="checked" <?php endif; ?> />
					<label for="exekuce">Mám exekuci</label>
				</div>

				<label>
					Fotografie nemovitosti:
					<input type="file" name="fotografie[]" multiple />
					<small style="font-size: 10px;">(Použijte Shift nebo Ctrl pro vybrání více souborů)</small>
				</label>

				<button type="submit" class="submit" name="submit">Odeslat</button>

				<?php if( !empty( $error ) ) : ?>
					<ul class="errors">
						<?php foreach( $error as $err ) : ?>
							<li><?php echo $err; ?></li>
						<?php endforeach; ?>
						<li>Pokud jste nahrávali fotografie, je třeba je zvolit znovu!</li>
					</ul>
				<?php endif; ?>

			</div>

		<?php else:

			include_once('mail/mail.php');

			$message = sprintf('
Odeslána nová žádost z webu asisteam.cz:<br>
<br>
Výše úvěru: %s,-Kč<br>
Doba splácení: %s let<br>
Vypočtená splátka: %s Kč/měsíc<br>
Vypočtené RPSN: %s %%<br>
Použitá úroková sazba: 10,99%%<br>
Jméno: %s<br>
Příjmení: %s<br>
Ulice: %s<br>
Č.p.: %s<br>
Město: %s<br>
PSČ: %s<br>
Telefon: %s<br>
E-mail: %s<br>
Poznámka: %s<br>
<br>
Údaje o nemovitosti k zajištění:<br>
Ulice: %s<br>
Č.p: %s<br>
PSČ: %s<br>
Město: %s<br>
Druh nemovitosti: %s<br>
Předpokládaná hodnota nemovitosti: %s<br>
Je vlastník nemovitosti: %s<br>
Je exekuce: %s<br>
Počet fotografií v příloze: %s<br>
<br>
IP Adresa odesílatele: %s<br>
<br>
(Pozn: Uživatel mohl přiložit cokoliv, neotevírejte podezřelé soubory v přílohách!)
			',
			$_POST['vyse_uveru'],
			$_POST['vyse_platby_v_mesicich'],
			$_POST['splatka'],
			$_POST['rpsn'],
			$_POST['jmeno'],
			$_POST['prijmeni'],
			$_POST['ulice'],
			$_POST['cp'],
			$_POST['mesto'],
			$_POST['psc'],
			$_POST['telefon'],
			$_POST['email'],
			$_POST['poznamka'],
			$_POST['zastava_ulice'],
			$_POST['zastava_cp'],
			$_POST['zastava_psc'],
			$_POST['zastava_mesto'],
			$_POST['druh_nemovitosti'],
			$_POST['predpokladana_hodnota'],
			(isset($_POST['jsem_vlastnik'])) ? 'Ano' : 'Ne',
			(isset($_POST['exekuce'])) ? 'Ano' : 'Ne',
			($_FILES['fotografie']['size'][0] == 0) ? 0 : count($_FILES['fotografie']['size']),
			$_SERVER['REMOTE_ADDR']
			);

			if( !is_dir('uploads') ) {
				mkdir('uploads');
			}

			$atts = array();

			if( isset( $_FILES['fotografie'] ) && $_FILES['fotografie']['size'][0] != 0 ) {

			for( $i = 0; $i < count( $_FILES['fotografie']['size'] ); $i++ ) {
			move_uploaded_file( $_FILES['fotografie']['tmp_name'][$i], 'uploads/' . $_FILES['fotografie']['name'][$i] );
			$atts[] = 'uploads/' . $_FILES['fotografie']['name'][$i];
			}

			}

			$mail_send = wp_mail( array( 'zadosti@asisteam.cz' ), 'Nová žádost z webu asisteam.cz!', $message, '', $atts );
			//$mail_send = wp_mail( array( 'lapak@lumiart.cz' ), 'Nová žádost z webu asisteam.cz!', $message, '', $atts );

			foreach( $atts as $file ) {
			unlink( $file );
			}

			?>

			<?php if( $mail_send == true ) : ?>
				<span style="color: green">Vaše žádost byla odeslána, budeme vás co nejdříve kontaktovat.</span><br/><br/>
				<a href="" style="color: #058dd3;" data-close-lightbox>Zavřít</a>
			<?php else : ?>
				<span style="color: red">Nepodařilo se odeslat žádost, zkuste se vrátit zpět a poslat ji znova, nebo nás kontaktovat jinak. Omlouváme se za potíže.</span>
				<a href="" style="color: #058dd3;" data-close-lightbox>Zavřít</a>
			<?php endif; ?>

		<?php endif; ?>

	</form>
</section>
<script type="text/javascript">
	var LumiPolyfill = { 'theme_path': '@@abspath/' };
</script>
<script type="text/javascript" src="@@abspath/js/layout.js"></script>
</body>
</html>