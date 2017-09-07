<?php
$nombre_servicio = $servicio['nombre_servicio'];
$descripcion_servicio = $servicio['descripcion_servicio'];
$url_servicio = $servicio['url_servicio'];
$itinerario = $servicio['itinerario'];
?>
<html>
<head>
	<title>Título de servicio.</title>

	<style>
		
		/* added for malaf */
		body hr {
			opacity: 0;
			page-break-after: always;
		}

		body {
			-ms-text-size-adjust: 100%;
			-webkit-text-size-adjust: 100%;
			color: #333;
			overflow: hidden;
			font-family: "Helvetica Neue", Helvetica, "Segoe UI", Arial, freesans, sans-serif;
			font-size: 10pt;
			line-height: 1.6;
			word-wrap: break-word;
		}

		body a {
			background: transparent;
		}

		body a:active,
		body a:hover {
			outline: 0;
		}

		body strong {
			font-weight: bold;
		}

		body h1 {
			font-size: 2em;
			margin: 0.67em 0;
		}

		body img {
			border: 0;
		}

		body hr {
			-moz-box-sizing: content-box;
			box-sizing: content-box;
			height: 0;
		}

		body pre {
			overflow: auto;
		}

		body code,
		body kbd,
		body pre {
			font-family: monospace, monospace;
			font-size: 1em;
		}

		body input {
			color: inherit;
			font: inherit;
			margin: 0;
		}

		body html input[disabled] {
			cursor: default;
		}

		body input {
			line-height: normal;
		}

		body input[type="checkbox"] {
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			padding: 0;
		}

		body table {
			border-collapse: collapse;
			border-spacing: 0;
		}

		body td,
		body th {
			padding: 0;
		}

		body * {
			-moz-box-sizing: border-box;
			box-sizing: border-box;
		}

		body input {
			font: 13px/1.4 Helvetica, arial, freesans, clean, sans-serif, "Segoe UI Emoji", "Segoe UI Symbol";
		}

		body a {
			color: #4183c4;
			text-decoration: none;
		}

		body a:hover,
		body a:active {
			text-decoration: underline;
		}

		body hr {
			height: 0;
			margin: 15px 0;
			overflow: hidden;
			background: transparent;
			border: 0;
			border-bottom: 1px solid #ddd;
		}

		body hr:before {
			display: table;
			content: "";
		}

		body hr:after {
			display: table;
			clear: both;
			content: "";
		}

		body h1,
		body h2,
		body h3,
		body h4,
		body h5,
		body h6 {
			margin-top: 15px;
			margin-bottom: 15px;
			line-height: 1.1;
		}

		body h1 {
			font-size: 30px;
		}

		body h2 {
			font-size: 21px;
		}

		body h3 {
			font-size: 16px;
		}

		body h4 {
			font-size: 14px;
		}

		body h5 {
			font-size: 12px;
		}

		body h6 {
			font-size: 11px;
		}

		body blockquote {
			margin: 0;
		}

		body ul,
		body ol {
			padding: 0;
			margin-top: 0;
			margin-bottom: 0;
		}

		body ol ol,
		body ul ol {
			list-style-type: lower-roman;
		}

		body ul ul ol,
		body ul ol ol,
		body ol ul ol,
		body ol ol ol {
			list-style-type: lower-alpha;
		}

		body dd {
			margin-left: 0;
		}

		body code {
			font-family: Consolas, "Liberation Mono", Menlo, Courier, monospace;
			font-size: 12px;
		}

		body pre {
			margin-top: 0;
			margin-bottom: 0;
			font: 12px Consolas, "Liberation Mono", Menlo, Courier, monospace;
		}

		body .octicon {
			font: normal normal 16px octicons-anchor;
			line-height: 1;
			display: inline-block;
			text-decoration: none;
			-webkit-font-smoothing: antialiased;
			-moz-osx-font-smoothing: grayscale;
			-webkit-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			user-select: none;
		}

		body .octicon-link:before {
			content: '\f05c';
		}

		body>*:first-child {
			margin-top: 0 !important;
		}

		body>*:last-child {
			margin-bottom: 0 !important;
		}

		body .anchor {
			position: absolute;
			top: 0;
			left: 0;
			display: block;
			padding-right: 6px;
			padding-left: 30px;
			margin-left: -30px;
		}

		body .anchor:focus {
			outline: none;
		}

		body h1,
		body h2,
		body h3,
		body h4,
		body h5,
		body h6 {
			position: relative;
			margin-top: 1em;
			margin-bottom: 16px;
			font-weight: bold;
			line-height: 1.4;
			page-break-after: avoid;
			page-break-before: avoid;
		}

		body p,
		body div {
			page-break-before: avoid;
			page-break-inside: avoid;
		}

		body h1 .octicon-link,
		body h2 .octicon-link,
		body h3 .octicon-link,
		body h4 .octicon-link,
		body h5 .octicon-link,
		body h6 .octicon-link {
			display: none;
			color: #000;
			vertical-align: middle;
		}

		body h1:hover .anchor,
		body h2:hover .anchor,
		body h3:hover .anchor,
		body h4:hover .anchor,
		body h5:hover .anchor,
		body h6:hover .anchor {
			padding-left: 8px;
			margin-left: -30px;
			text-decoration: none;
		}

		body h1:hover .anchor .octicon-link,
		body h2:hover .anchor .octicon-link,
		body h3:hover .anchor .octicon-link,
		body h4:hover .anchor .octicon-link,
		body h5:hover .anchor .octicon-link,
		body h6:hover .anchor .octicon-link {
			display: inline-block;
		}

		body h1 {
			padding-bottom: 0.3em;
			font-size: 2.25em;
			line-height: 1.2;
			border-bottom: 1px solid #eee;
		}

		body h1 .anchor {
			line-height: 1;
		}

		body h2 {
			padding-bottom: 0.3em;
			font-size: 1.75em;
			line-height: 1.225;
			border-bottom: 1px solid #eee;
		}

		body h2 .anchor {
			line-height: 1;
		}

		body h3 {
			font-size: 1.5em;
			line-height: 1.43;
		}

		body h3 .anchor {
			line-height: 1.2;
		}

		body h4 {
			font-size: 1.25em;
		}

		body h4 .anchor {
			line-height: 1.2;
		}

		body h5 {
			font-size: 1em;
		}

		body h5 .anchor {
			line-height: 1.1;
		}

		body h6 {
			font-size: 1em;
			color: #777;
		}

		body h6 .anchor {
			line-height: 1.1;
		}

		body p,
		body blockquote,
		body ul,
		body ol,
		body dl,
		body table,
		body pre {
			margin-top: 0;
			margin-bottom: 16px;
		}

		body hr {
			height: 4px;
			padding: 0;
			margin: 16px 0;
			background-color: #e7e7e7;
			border: 0 none;
		}

		body ul,
		body ol {
			padding-left: 2em;
		}

		body ul ul,
		body ul ol,
		body ol ol,
		body ol ul {
			margin-top: 0;
			margin-bottom: 0;
		}

		body li>p {
			margin-top: 16px;
		}

		body dl {
			padding: 0;
		}

		body dl dt {
			padding: 0;
			margin-top: 16px;
			font-size: 1em;
			font-style: italic;
			font-weight: bold;
		}

		body dl dd {
			padding: 0 16px;
			margin-bottom: 16px;
		}

		body blockquote {
			padding: 0 15px;
			color: #777;
			border-left: 4px solid #ddd;
		}

		body blockquote>:first-child {
			margin-top: 0;
		}

		body blockquote>:last-child {
			margin-bottom: 0;
		}

		body table {
			display: block;
			width: 100%;
			overflow: auto;
			word-break: normal;
			word-break: keep-all;
		}

		body table th {
			font-weight: bold;
		}

		body table th,
		body table td {
			padding: 6px 13px;
			border: 1px solid #ddd;
		}

		body table tr {
			background-color: #fff;
			border-top: 1px solid #ccc;
		}

		body table tr:nth-child(2n) {
			background-color: #f8f8f8;
		}

		body img {
			max-width: 100%;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
		}

		body code {
			padding: 0;
			padding-top: 0.2em;
			padding-bottom: 0.2em;
			margin: 0;
			font-size: 85%;
			background-color: rgba(0,0,0,0.04);
			border-radius: 3px;
		}

		body code:before,
		body code:after {
			letter-spacing: -0.2em;
			content: "\00a0";
		}

		body pre>code {
			padding: 0;
			margin: 0;
			font-size: 100%;
			word-break: normal;
			white-space: pre;
			background: transparent;
			border: 0;
		}

		body .highlight {
			margin-bottom: 16px;
		}

		body .highlight pre,
		body pre {
			padding: 16px;
			overflow: auto;
			font-size: 85%;
			line-height: 1.45;
			background-color: #f7f7f7;
			border-radius: 3px;
		}

		body .highlight pre {
			margin-bottom: 0;
			word-break: normal;
		}

		body pre {
			word-wrap: normal;
		}

		body pre code {
			display: inline;
			max-width: initial;
			padding: 0;
			margin: 0;
			overflow: initial;
			line-height: inherit;
			word-wrap: normal;
			background-color: transparent;
			border: 0;
		}

		body pre code:before,
		body pre code:after {
			content: normal;
		}

		body kbd {
			display: inline-block;
			padding: 3px 5px;
			font-size: 11px;
			line-height: 10px;
			color: #555;
			vertical-align: middle;
			background-color: #fcfcfc;
			border: solid 1px #ccc;
			border-bottom-color: #bbb;
			border-radius: 3px;
			box-shadow: inset 0 -1px 0 #bbb;
		}

		body .pl-c {
			color: #969896;
		}

		body .pl-c1,
		body .pl-mdh,
		body .pl-mm,
		body .pl-mp,
		body .pl-mr,
		body .pl-s1 .pl-v,
		body .pl-s3,
		body .pl-sc,
		body .pl-sv {
			color: #0086b3;
		}

		body .pl-e,
		body .pl-en {
			color: #795da3;
		}

		body .pl-s1 .pl-s2,
		body .pl-smi,
		body .pl-smp,
		body .pl-stj,
		body .pl-vo,
		body .pl-vpf {
			color: #333;
		}

		body .pl-ent {
			color: #63a35c;
		}

		body .pl-k,
		body .pl-s,
		body .pl-st {
			color: #a71d5d;
		}

		body .pl-pds,
		body .pl-s1,
		body .pl-s1 .pl-pse .pl-s2,
		body .pl-sr,
		body .pl-sr .pl-cce,
		body .pl-sr .pl-sra,
		body .pl-sr .pl-sre,
		body .pl-src {
			color: #df5000;
		}

		body .pl-mo,
		body .pl-v {
			color: #1d3e81;
		}

		body .pl-id {
			color: #b52a1d;
		}

		body .pl-ii {
			background-color: #b52a1d;
			color: #f8f8f8;
		}

		body .pl-sr .pl-cce {
			color: #63a35c;
			font-weight: bold;
		}

		body .pl-ml {
			color: #693a17;
		}

		body .pl-mh,
		body .pl-mh .pl-en,
		body .pl-ms {
			color: #1d3e81;
			font-weight: bold;
		}

		body .pl-mq {
			color: #008080;
		}

		body .pl-mi {
			color: #333;
			font-style: italic;
		}

		body .pl-mb {
			color: #333;
			font-weight: bold;
		}

		body .pl-md,
		body .pl-mdhf {
			background-color: #ffecec;
			color: #bd2c00;
		}

		body .pl-mdht,
		body .pl-mi1 {
			background-color: #eaffea;
			color: #55a532;
		}

		body .pl-mdr {
			color: #795da3;
			font-weight: bold;
		}

		body kbd {
			display: inline-block;
			padding: 3px 5px;
			font: 11px Consolas, "Liberation Mono", Menlo, Courier, monospace;
			line-height: 10px;
			color: #555;
			vertical-align: middle;
			background-color: #fcfcfc;
			border: solid 1px #ccc;
			border-bottom-color: #bbb;
			border-radius: 3px;
			box-shadow: inset 0 -1px 0 #bbb;
		}

		body .task-list-item {
			list-style-type: none;
		}

		body .task-list-item+.task-list-item {
			margin-top: 3px;
		}

		body .task-list-item input {
			float: left;
			margin: 0.3em 0 0.25em -1.6em;
			vertical-align: middle;
		}

		body :checked+.radio-label {
			z-index: 1;
			position: relative;
			border-color: #4183c4;
		}
	</style>
</head>
<body>
	<div>
		<h1 class="pl-mdr"><?php echo $nombre_servicio;?>></h1>
	</div>

	<table>
		<tbody>
			<tr>
				<td><div>
					<a href="#">
						<img src="<?php echo $cabeceras['logo'];?>" alt="<?php echo $website['title'];?>">
					</a>
				</div></td>
			</tr>
			<tr>
				<td>
					<h1 style="color:#ffffff;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:30px;font-weight:300;line-height:150%;margin:0;text-align:left">
						<?php echo $nombre_servicio;?>
					</h1>
				</td>
			</tr>

			<tr>
				<td style="padding: 0 40px;">
					<?php

					if(!empty($busqueda_info)){
						$date_range = date_range($busqueda_info['dateDesde'], $busqueda_info['dateHasta']);
					}

					?>
					<table style="font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:12px;">
						<tr>
							<td colspan="2">
								<!-- <h2 style="margin:6px 0;"><?php echo $nombre_servicio;?></h2> -->
								<p><a href="<?php echo $url_servicio;?>" target="_blank"><?php echo 'Ver detalles en la página web.';?></a></p>
								<?php echo $descripcion_servicio;?>
							</td>
						</tr>
						<tr>
							<td colspan="2">&nbsp;</td>
						</tr>
						<tr>
							<td colspan="2">&nbsp;</td>
						</tr>
						<tr>
							<td colspan="2">
								<h2 style="margin:6px 0;">Itinerario:</h2>
							</td>
						</tr>
						<?php
						$iiDia = 1;
						foreach ($itinerario as $key => $value) {
							$urlImagen = (!empty($value['nombre_imagen'])) ? base_url($this->config->item('upload_path') . $value['nombre_imagen']) : base_url('assets/images/no-image.jpg') ;
							$str_fecha = (!empty($date_range[$key])) ? nice_date($date_range[$key], 'd/m/Y') : 'Día ' . $iiDia;
							?>
							<tr>
								<td style="vertical-align: top;">
									<div style="padding: 0 10px 0 0;">
										<p style="color: #333;"><?php echo $str_fecha;?></p>
										<h3 style="margin:6px 0;"><?php echo $value['titulo'];?></h3>
										<p style="text-align: justify;"><?php echo $value['descripcion'];?></p>
									</div>
								</td>
								<td style="width: 200px; vertical-align: middle;">
									<img src="<?php echo $urlImagen;?>" style="max-width: 200px;">
								</td>
							</tr>
							<tr>
								<td colspan="2"><hr></td>
							</tr>
							<?php 
							$iiDia++;
						}
						?>
					</table>
				</td>
			</tr>

			<tr>
				<td colspan="2" valign="middle" style="padding:0 48px 48px 48px;border:0;color:#99b1c7;font-family:Arial;font-size:12px;line-height:125%;text-align:center">
					<p><a href="<?php echo "//" . $cabeceras['dominio']; ?>" target="_blank"><?php echo $cabeceras['dominio']; ?></a></p>
				</td>
			</tr>
		</tbody>
	</table>

</body>
</html>

