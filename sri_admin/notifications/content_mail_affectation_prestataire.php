<?php
$htmlversion = '
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html lang="fr">

	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title></title>
	<style type="text/css">
		div[style*="margin: 16px 0"] {
		  margin: 0 !important;
		}
		@media screen and (max-width: 499px) {
		  .inner {
		    padding-top: 24px !important;
		    padding-left: 24px !important;
		    padding-right: 24px !important;
		  }
		  img {
		    height: auto !important;
		  }
		}
		@media screen and (max-width: 620px) {
		  .hide {
		    display: none !important;
		  }
		}
		a.link-hover {
		  color: #333333;
		  text-decoration: underline;
		}
		a.link-hover:hover {
		  text-decoration: none !important;
		  color: #aace01 !important;
		}
		.section-footer a:hover {
		  text-decoration: underline !important;
		}
		a[x-apple-data-detectors=true] {
		  text-decoration: none !important;
		  color: inherit !important;
		  cursor: default;
		}
		.preheader {display: none;}
		.btn {
			display: inline-block;
			padding: 10px 20px;
			color: white;
			background-color: #17a2b8;
			border-radius: 5px;
			text-decoration: none;
			text-align: center;
		}
		.btn i {
			margin-right: 5px; 
			
		}
	</style>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdi/2.2.43/css/materialdesignicons.min.css" />
	<!--[if !mso]><!-->
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<!--<![endif]-->
	<!--[if mso]>
	<style type="text/css">
		table {border-collapse: collapse !important;}
		table, div {font-family: Arial, sans-serif !important;}
		.button {padding: 4px 6px 4px 6px !important;}
	</style>
	<![endif]-->
</head>
<body style="font-family:Arial,sans-serif;margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;background-color:#f5f7fa;-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale;">
<div class="preheader mktEditable" id="Preheader" style="mso-hide:all;visibility:hidden;opacity:0;color:transparent;mso-line-height-rule:exactly;line-height:0;font-size:0;overflow:hidden;border-width:0;display:none !important;"><p style="margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;"></p></div>
<table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" class="wrapper" style="margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;font-family:Arial,sans-serif;table-layout:fixed;width:100%;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;background-color:#f5f7fa;">
	<tr>
		<td align="center">
			<center>
				<div class="webkit" style="margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;width:94%;max-width:600px;">
					
					<!--[if(mso)|(IE)]>
					<table cellpadding="0" cellspacing="0" border="0" width="600"><tr><td>
					<![endif]-->

					<table width="100%" cellpadding="0" cellspacing="0" border="0" class="outer" style="margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;width:100%;max-width:600px;">
					<tr class="hide"><td style="font-size:20px;line-height:20px;">&nbsp;</td></tr>
						<tr>
							<td>
								<!-- Masthead -->
								<table width="100%" cellpadding="0" cellspacing="0" border="0" class="contents section-masthead" style="font-size:14px;line-height:22px;text-align:left;">
									<tr class="one-col">
										<td class="inner type" align="center" style="font-family:Arial,sans-serif;padding-right:30px;padding-left:30px;padding-top:26px;padding-bottom:24px;">
											<div class="mktEditable" id="logo">
												<p style="margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;"><a href="#" style="text-decoration:none;color:inherit;"><img src="https://sedif.sn/dtai/pgav/logo.png" alt="DTAI" width="185" style="border-width:0;height:auto;-ms-interpolation-mode:bicubic;display:block;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;max-width:70%;" /></a></p>
											</div>
											<h1>SRI - DAGE</h1>
										</td>
									</tr>
								</table>
								<!-- Main -->
								<table width="100%" cellpadding="0" cellspacing="0" border="0" class="section-main contents" style="font-size:14px;line-height:22px;background-color:#ffffff;color:#333333;text-align:left;border-width:1px;border-style:solid;border-color:#d4dae6;border-bottom-width:1px;border-bottom-style:solid;border-bottom-color:#b3bdd2;">
									<tr class="one-col">
										<td class="inner type" style="font-family:Arial,sans-serif;padding-top:30px;padding-bottom:30px;padding-right:30px;padding-left:30px;">
											<div class="mktEditable" id="main-content">
												<p style="margin-top:0;margin-right:0;margin-left:0;margin-bottom:8px;">Bonjour ' . $prestataire . ', </p>
	
												<p style="margin-top:0;margin-right:0;margin-left:0;margin-bottom:8px;">Une demande d\'intervention provenant du service ' . $service . ' vous est assignée.</br></p>
												<p style="margin-top:0;margin-right:0;margin-left:0;margin-bottom:8px;">La demande porte la référence <strong>' . $numero_incident . '</strong></p>
												<p style="margin-top:0;margin-right:0;margin-left:0;margin-bottom:8px;">Type d\'intervention : <strong style="color:red">' . $type_incident . '</strong></p>
												<p style="margin-top:0;margin-right:0;margin-left:0;margin-bottom:8px;">Description : <strong>' . $description . '</strong></p>
                                                <p style="margin-top:0;margin-right:0;margin-left:0;margin-bottom:8px;">Localisation : <strong style="color:blue">' . $localisation . '</strong></p>
                                                <p style="margin-top:0;margin-right:0;margin-left:0;margin-bottom:8px;">Contact : <strong>' . $contact . '</strong></p>
												<p style="margin-top:0;margin-right:0;margin-left:0;margin-bottom:8px;">&nbsp;</p>
												
												<p style="text-align:center;font-size:12px;line-height:15px;margin-bottom:5px;margin-top:0;margin-right:0;margin-left:0;">
													<a href="http://localhost/sri_gassama/sri_admin/fiche_pdf?code_intervention=' . $code_intervention . '" class="btn" target="_blank">
														<i class="mdi mdi-printer"></i> Imprimer la fiche d\'intervention
													</a>
												</p>

												<p style="text-align:center;font-size:12px;line-height:15px;margin-bottom:5px;margin-top:0;margin-right:0;margin-left:0;">
													DAGE - MFB<br/><span style="color:#a3afc8;">Gestion des Bâtiments</span>
												</p>
											</div>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td>
								<table width="100%" cellpadding="0" cellspacing="0" border="0" class="section-footer">
									<tr class="one-col">
										<td class="inner" style="padding-top:44px;padding-bottom:26px;padding-right:15px;padding-left:15px;">
											<table cellpadding="0" cellspacing="0" border="0" width="100%" class="contents" style="font-size:12px;line-height:16px;color:#a3afc8;text-align:center;">
												<tr>
													<td  class="type" style="padding-bottom:10px;font-family:Arial,sans-serif;">
														<table align="center" cellpadding="0" cellspacing="0" border="0" class="social" style="font-size:8px;line-height:10px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;">
															<tr>
	
															</tr>
														</table>
													</td>
												</tr>
												<tr>
													<td class="type" style="font-family:Arial,sans-serif;">
														<div class="mktEditable" id="footer">
															<p style="margin-top:0;margin-right:0;margin-left:0;margin-bottom:4px;">Direction du Traitement Automatique de l\'information</p>
															<p style="margin-top:0;margin-right:0;margin-left:0;margin-bottom:4px;"><b><a href="{{system.forwardToFriendLink}}" style="text-decoration:none;color:#a3afc8;">Tel</a> &middot; <a href="{{system.unsubscribeLink}}" style="text-decoration:none;color:#a3afc8;">(+221) 33 824 33 33</a> &middot; <a href="{{system.viewAsWebpageLink}}" style="text-decoration:none;color:#a3afc8;">dtai@minfinances.sn</a></b></p>
														</div>
													</td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
							</td>
						</tr>	
					</table>
					
					<!--[if(mso)|(IE)]>
					</td></tr></table>
					<![endif]-->

				</div>
			</center>
		</td>
	</tr>
</table>
</body>
</html>';
