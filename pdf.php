<?php
require_once('tcpdf/tcpdf.php');

// Create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Set document information
$pdf->SetCreator('Henly Tech');
$pdf->SetAuthor('Henly Tech');
$pdf->SetTitle('Internship Offer Letter');
$pdf->SetSubject('Internship Offer Letter');
$pdf->SetKeywords('Internship, Offer, Web Developer');

// Remove default margins, headers, and footers
$pdf->SetPrintHeader(false);
$pdf->SetPrintFooter(false);
$pdf->SetMargins(20, 20, 30);
$pdf->SetAutoPageBreak(false, 0);

// Add a page
$pdf->AddPage();

// Add Montserrat fonts (Ensure the font files exist in the fonts/ folder)
$montserrat = TCPDF_FONTS::addTTFfont('fonts/Montserrat-Regular.ttf', 'TrueTypeUnicode', '', 96);
$montserrat_bold = TCPDF_FONTS::addTTFfont('fonts/Montserrat-Bold.ttf', 'TrueTypeUnicode', '', 96);
$pdf->SetFont($montserrat, '', 12);

// Header section with logo and title
$header = '
<table width="100%">
    <tr>
        <td width="40%"><img src="img/logo.png" width="200"></td>
        <td width="60%" style="text-align:right; font-size:18px; font-weight:bold; color:#590696; font-family:Montserrat-Bold;">
            INTERNSHIP <br>OFFER LETTER
        </td>
    </tr>
</table>
';

// Write header
$pdf->writeHTML($header, true, false, true, false, '');

// Space after header
$pdf->Ln(10);

$pdf->SetLineWidth(0.2); // Set line thickness
$pdf->Line(20, $pdf->GetY(), 178, $pdf->GetY()); // Draw line from (X1, Y1) to (X2, Y2)
$pdf->Ln(5); // Add space after the line

// Space after header
$pdf->Ln(10);

// Set font to Montserrat-Bold
$pdf->SetFont($montserrat_bold, '', 12);

// Date and Batch No in the same row
$date_section = '
<table width="100%">
    <tr>
        <td width="50%"><p>Date: 31-03-2025</p></td>
        <td width="50%" style="text-align:right;"><p><b>HT-ML00010</b></p></td>
    </tr>
</table>
';

$pdf->writeHTML($date_section, true, false, true, false, '');


// Recipient
$recipient = '<p>Dear Sopitha S,</p>';
$pdf->writeHTML($recipient, true, false, true, false, '');

// Set font back to Montserrat-Medium
$pdf->SetFont($montserrat, '', 11);

$pdf->Ln(4);

// Body Content with Justified Text
$content = '
<p style="text-align:justify; line-height:1.6;">Congratulations! We are pleased to offer you the position of a <b>Web Developer Intern</b> at <b>Henly Tech</b>. We are confident that this internship will provide you with valuable experience in the field of web development, offering you an opportunity to learn and grow in a professional environment. You are invited to join us for this internship, effective from <b>31-03-2025 to 07-04-2025</b>.</p>
<p style="text-align:justify; line-height:1.6;">During your internship, you will work closely with our experienced team, gaining practical knowledge of web development technologies, including <b>HTML, CSS, and Bootstrap</b>. You will also be involved in hands-on tasks and projects that will enhance your skills in designing and building responsive web pages.</p>
<p style="text-align:justify; line-height:1.6;">We are excited to have you on board and look forward to seeing the innovative solutions you will contribute to our projects.</p>
<p>Welcome to the team!</p>
<br>
<p><b>Thank You</b></p>
';
// Write body content
$pdf->writeHTML($content, true, false, true, false, '');

$pdf->Ln(6);

// Signature and Google logo in the same row
$signature_section = '
<table width="100%">
    <tr>
        <td width="50%"><img src="img/sign.png" width="120"></td>
        <td width="50%" style="text-align:right;"><img src="img/google.png" width="80"></td>
    </tr>
</table>
';

// Write signature section
$pdf->writeHTML($signature_section, true, false, true, false, '');

$pdf->SetY($pdf->GetY() - 8);
// Set font to Montserrat-Bold
$pdf->SetFont($montserrat_bold, '', 12);

// Name under signature
$name_section = '<p><b>Ajay K</b></p>';
$pdf->writeHTML($name_section, true, false, true, false, '');

// Add the image to the top-right corner
$imagePath = 'img/border.png';  // Path to your image
$imageWidth = 52;  // Adjust the image width
$imageHeight = 250; // Adjust the image height
$pdf->Image($imagePath, 158, 0, $imageWidth, $imageHeight, 'PNG');

// Set absolute footer
$footerText = "+91 94862 80683 | info.henlytech@gmail.com | Gorimedu, Puducherry, India";
// Set absolute footer with full width
$pdf->SetY(265); // Move to the bottom of the page
$pdf->SetX(0); // Set X position to start from the left edge
$pdf->SetFillColor(89, 6, 150); // Set background color to #590696
$pdf->SetTextColor(255, 255, 255); // Set text color to white
$pdf->SetFont($montserrat, '', 10);
$pdf->Cell(210, 35, $footerText, 0, 1, 'C', 1); // Full-width footer (A4 width is 210mm)

// Display the PDF in the browser (instead of downloading)
$pdf->Output('Internship_Offer_Letter.pdf', 'I');
?>
