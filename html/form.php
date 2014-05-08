<?php session_start(); ?>
@@header

<h1>Žádost o úvěr</h1>

<?php
if( !isset( $_POST['vyse_uveru'] ) ) {
	$vyse_uveru = 100000;
} else {
	$vyse_uveru = $_POST['vyse_uveru'];
}

if( !isset( $_POST['vyse_platby_v_mesicich'] ) ) {
	$vyse_platby_v_mesicich = 10;
} else {
	$vyse_platby_v_mesicich = $_POST['vyse_platby_v_mesicich'];
}


//input validate
$error = false;

if( isset( $_POST['step1_submit'] ) ) {

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

	if( empty( $_POST['adresa'] ) ) {
		$error[] = 'Musíte vyplnit adresu.';
	}

	if( empty( $_POST['telefon'] ) ) {
		$error[] = 'Musíte vyplnit telefon.';
	}

	if( empty( $_POST['email'] ) ) {
		$error[] = 'Musíte vyplnit e-mail.';
	}

	if(  strtolower($_POST['captcha']) != strtolower($_SESSION['captcha']['code']) ) {
		$error[] = 'Musíte vyplnit správný ověřovací kód.';
	}

}


if( !isset( $_POST['step1_submit'] ) || $error != false ):

	include("captcha/simple-php-captcha.php");
	$_SESSION['captcha'] = simple_php_captcha();

?>

<?php if( $error != false ) : ?>
	<ul style="color: red;">
		<?php foreach( $error as $item ) : ?>
			<li><?php echo $item; ?></li>
		<?php endforeach; ?>
	</ul>
<?php endif; ?>

<section class="calculator" style="float: none; width: 50%">
	<form id="calculator" data-compute-rightaway="true" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<label class="select">
			Výše úvěru:
			<div class="style_wrap">
				<select name="vyse_uveru">
					<option value="100000"<?php if( $vyse_uveru == 100000 ): ?> selected="selected"<?php endif; ?>>100.000 Kč</option>
					<option value="200000"<?php if( $vyse_uveru == 200000 ): ?> selected="selected"<?php endif; ?>>200.000 Kč</option>
					<option value="300000"<?php if( $vyse_uveru == 300000 ): ?> selected="selected"<?php endif; ?>>300.000 Kč</option>
					<option value="400000"<?php if( $vyse_uveru == 400000 ): ?> selected="selected"<?php endif; ?>>400.000 Kč</option>
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
			<strong>Splátka:</strong>
			<div class="box">
				<strong><span id="calculator_splatka">1 552,06</span> Kč</strong>
				úrok 13.99% p.a.
			</div>
		</div>
		<div class="rpsn">
			RPSN
			<div class="box">
				<span id="calculator_rpsn">18,68</span>%
			</div>
		</div>

		<label>
			Jméno:
			<input type="text" name="jmeno" value="<?php if( isset( $_POST['jmeno'] ) ) echo $_POST['jmeno']; ?>" />
		</label>

		<label>
			Přijmení:
			<input type="text" name="prijmeni" value="<?php if( isset( $_POST['prijmeni'] ) ) echo $_POST['prijmeni']; ?>" />
		</label>

		<label>
			Adresa:
			<textarea name="adresa"><?php if( isset( $_POST['adresa'] ) ) echo $_POST['adresa']; ?></textarea>
		</label>

		<label>
			Telefon:
			<input type="text" name="telefon" value="<?php if( isset( $_POST['telefon'] ) ) echo $_POST['telefon']; ?>" />
		</label>

		<label>
			E-mail:
			<input type="text" name="email" value="<?php if( isset( $_POST['email'] ) ) echo $_POST['email']; ?>" />
		</label>

		<label>
			Poznámka:
			<textarea name="poznamka" cols="30" rows="10"><?php if( isset( $_POST['poznamka'] ) ) echo $_POST['poznamka']; ?></textarea>
		</label>

		<div class="checkbox">
			<input type="checkbox" id="checkbox" data-osobni-udaje="true" name="checkbox" <?php if( isset( $_POST['checkbox'] ) && $_POST['checkbox'] == 'on' ) : ?>checked="checked" <?php endif; ?> />
			<label for="checkbox"><a href="podminky.html" target="_blank" class="open_terms">Souhlasím se zpracováním osobních údajů</a></label>
		</div>

		<label>
			Opište kód z obrázku:
			<img src="<?php echo $_SESSION['captcha']['image_src']; ?>" alt=""/>
			<input type="text" name="captcha" />
		</label>

		<button type="submit" class="submit" name="step1_submit">Pokračovat</button>

	</form>
</section>

<?php endif; ?>

<?php
//2ND step
if( isset( $_POST['step1_submit'] ) && $error == false ):

$include_secret = 'secret';
global $include_secret;
require_once('calculator.php');
$data = calculate( $_POST['vyse_uveru'], $_POST['vyse_platby_v_mesicich'] );

?>
<h2>Zkontrolujte si údaje:</h2>

<table>
	<tr>
		<td><strong>Výše úvěru:</strong></td>
		<td><?php echo $_POST['vyse_uveru']; ?>,- Kč</td>
	</tr>
	<tr>
		<td><strong>Doba splácení:</strong></td>
		<td><?php echo $_POST['vyse_platby_v_mesicich']; ?> roků</td>
	</tr>
	<tr>
		<td><strong>Splátka:</strong></td>
		<td><?php echo $data['splatka']; ?> Kč / měsíc</td>
	</tr>
	<tr>
		<td><strong>RPSN:</strong></td>
		<td><?php echo $data['rpsn']; ?>%</td>
	</tr>
	<tr>
		<td><strong>Jméno:</strong></td>
		<td><?php echo $_POST['jmeno']; ?></td>
	</tr>
	<tr>
		<td><strong>Příjmení:</strong></td>
		<td><?php echo $_POST['prijmeni']; ?></td>
	</tr>
	<tr>
		<td><strong>Adresa:</strong></td>
		<td><?php echo $_POST['adresa']; ?></td>
	</tr>
	<tr>
		<td><strong>Telefon:</strong></td>
		<td><?php echo $_POST['telefon']; ?></td>
	</tr>
	<tr>
		<td><strong>E-Mail:</strong></td>
		<td><?php echo $_POST['email']; ?></td>
	</tr>
	<tr>
		<td><strong>Poznámka:</strong></td>
		<td><?php echo $_POST['poznamka']; ?></td>
	</tr>


</table>

<h2>Údaje o nemovitosti, která bude předmětem zástavy</h2>




<?php endif; ?>

@@footer
 