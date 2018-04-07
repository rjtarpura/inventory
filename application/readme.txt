.htaccess steps link
https://stackoverflow.com/questions/19183311/codeigniter-removing-index-php-from-url

rakesh added from home

label
H 1 inch
W 1 inch
T,B Margin 0.5 inch
L,R Margin 0.25 inch
H,V Spacing 0
H,V Pitch 1


/*
	// REMARKS	
	A4 Sheet Size 8.27X11.69 inch
*/


/*
	// PARAMETORS
	Page Width			=	$pw
	Page Height			=	$ph

	Page Margin 		=	$tm,$bm,$lm,$rm 	(if all margin are same tm=bm=lm=rm)

	Pitch Between Labels=	$vp,$hp

	Label Dimension		=	$lw,$lh

	Label Border		=	$lb 				(true/false Default:false)
	Label Border Width	=	$lbw				(Set if lb is true, Default : 0)
	Label Border Style	=	$lbs				(String Value Default : '')

	RELATION
	iw+ipl+ipr+iml+imr 	=	lw+(2*lbw)				=	pw+ppl+ppr+pml+pmr
	ih+ipt+ipb+imt+imb	+	ph+ppt+ppb+pmt+pmb 		=	lh+(2*lbw);

*/


// Parametor Setup

$pw		=
$ph 	=

$tm		=
$bm		=
$lm		=
$rm 	=

$vp		=
$hp 	=

$lw 	=
$lh 	=

$lb 	=	false;
$lbw	=	0;
$lbs 	=	'';


$ipt 	=	0;	$ipb 	=	0;	$ipl 	=	0;	$ipr 	=	0;		// Image Padding
$imt	=	0;	$imb	=	0;	$iml	=	0;	$imr	=	0;		// Image Margin

$ppt 	=	0;	$ppb 	=	0;	$ppl 	=	0;	$ppr 	=	0;		// Paragraph Padding
$pmt	=	0;	$pmb	=	0;	$pml	=	0;	$pmr	=	0;		// Paragraph Margin

// Program Execution

if($lb){
	$lw -= 2 * $lbw;
	$lh -= 2 * $lbw;
}

$iw	=	$lw + ( 2 * $lbw ) - ( $ipl + $ipr + $iml + $imr );
$ih =	$lh + ( 2 * $lbw ) - ( $ipt + $ipb + $imt + $imb );

$pw =	$lw + ( 2 * $lbw ) - ( $ppl + $ppr + $pml + $pmr );
$ph =	$lh + ( 2 * $lbw ) - ( $ppt + $ppb + $pmt + $pmb );

$top_pointer = $tm
$$left_pointer = $lm

for(iterate all label data) {
	
	if( $left_pointer > ( $pw - $rm ) ) {
		
		$left_pointer	=	$lm;
		$top_pointer	+=	$lh+$vp;
	}

	if( top_pointer > ( $ph - $rm ) {

		$top_pointer	=	$tm;
		//insert_page_break();
	}

	//print_label($top_pointer,$left_pointer);

	$left_pointer	+=	( $lw + $hp );
}