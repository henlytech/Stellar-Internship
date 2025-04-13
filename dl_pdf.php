<?php
require_once('config.php'); 
require_once('tcpdf/tcpdf.php');

// Check if 'id' is provided
if (!isset($_GET['id'])) {
    die("Error: ID not provided.");
}

$id = $_GET['id'];

// Fetch user details from `dl` table
$userQuery = "SELECT name FROM dl WHERE id = ?";
$stmt = $conn->prepare($userQuery);
$stmt->bind_param("s", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Error: No user found with the given ID.");
}

$user = $result->fetch_assoc();
$name = $user['name'];

// Fetch the latest batch number
$batchNoQuery = "SELECT MAX(batch_no) AS latest_batch FROM batch";
$result = $conn->query($batchNoQuery);
$batch = $result->fetch_assoc();
$latest_batch = $batch['latest_batch'];

// Fetch batch details
$batchQuery = "SELECT start_date, end_date FROM batch WHERE batch_no = ?";
$stmt = $conn->prepare($batchQuery);
$stmt->bind_param("i", $latest_batch);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Error: No batch data found.");
}

$batch = $result->fetch_assoc();
$start_date = $batch['start_date'];
$end_date = $batch['end_date'];

// Format dates to dd/mm/yyyy
$start_date = date('d/m/Y', strtotime($start_date));
$end_date = date('d/m/Y', strtotime($end_date));

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

// Add Montserrat fonts
$montserrat = TCPDF_FONTS::addTTFfont('fonts/Montserrat-Regular.ttf', 'TrueTypeUnicode', '', 96);
$montserrat_bold = TCPDF_FONTS::addTTFfont('fonts/Montserrat-Bold.ttf', 'TrueTypeUnicode', '', 96);
$pdf->SetFont($montserrat, '', 12);

// Header with logo & title
$header = '
<table width="100%">
    <tr>
        <td width="40%"><img src="img/logo.png" width="200"></td>
        <td width="60%" style="text-align:right; font-size:18px; font-weight:bold; color:#590696; font-family:Montserrat-Bold;">
            INTERNSHIP <br>OFFER LETTER
        </td>
    </tr>
</table>';
$pdf->writeHTML($header, true, false, true, false, '');
$pdf->Ln(10);

$pdf->SetLineWidth(0.2);
$pdf->Line(20, $pdf->GetY(), 178, $pdf->GetY());
$pdf->Ln(5);

// Date & Batch No
$date_section = '
<table width="100%">
    <tr>
        <td width="50%"><p style="font-weight:bold;">Date: ' . date('d/m/Y') . '</p></td>
        <td width="50%" style="text-align:right;"><p style="font-weight:bold;"><b>' . $id . '</b></p></td>
    </tr>
</table>';
$pdf->writeHTML($date_section, true, false, true, false, '');

// Recipient
$recipient = '<p style="font-weight:bold;">Dear ' . $name . ',</p>';
$pdf->writeHTML($recipient, true, false, true, false, '');
$pdf->Ln(4);

// Body Content
$content = '
<p style="text-align:justify; line-height:1.6;">
Congratulations! We are pleased to offer you the position of a <b>Deep Learning Intern</b> at <b>Henly Tech</b>. 
We are confident that this internship will provide you with valuable experience in the field of Artificial Intelligence, offering you an opportunity to learn and grow in a professional environment. You are invited to join us for this internship, effective from <b>' . $start_date . ' to ' . $end_date . '</b>.
</p>
<p style="text-align:justify; line-height:1.6;">
During your internship, you will work closely with our experienced team, gaining practical knowledge of <b>Artificial intelligence technologies</b>, including <b>Deep learning, data analysis</b>, and <b>AI model development.</b> You will also be involved in innovative projects that enhance your skills in developing AI-powered solutions.
</p>
<p style="text-align:justify; line-height:1.6;">
We are excited to have you on board and look forward to seeing the innovative solutions you will contribute to our projects.
</p>
<p>Welcome to the team!</p>
<br>
<p><b>Thank You</b></p>';
$pdf->writeHTML($content, true, false, true, false, '');
$pdf->Ln(6);

// Signature and Google logo
$signature_section = '
<table width="100%">
    <tr>
        <td width="50%"><img src="img/sign.png" width="120"></td>
        <td width="50%" style="text-align:right;"><img src="img/google.png" width="80"></td>
    </tr>
</table>';
$pdf->writeHTML($signature_section, true, false, true, false, '');

$pdf->SetY($pdf->GetY() - 8);
$pdf->SetFont($montserrat_bold, '', 12);
$name_section = '<p><b>Ajay K</b></p>';
$pdf->SetFont($montserrat, '', 11);
$position_section = '<p>Hiring Manager, Henly Tech</p>';
$pdf->writeHTML($name_section, true, false, true, false, '');
$pdf->writeHTML($position_section, true, false, true, false, '');

// Border Image
$pdf->Image('img/border.png', 158, 0, 52, 250, 'PNG');

// Footer
$footerText = "+91 94862 80683 | info.henlytech@gmail.com | Gorimedu, Puducherry, India";
$pdf->SetY(265);
$pdf->SetX(0);
$pdf->SetFillColor(89, 6, 150);
$pdf->SetTextColor(255, 255, 255);
$pdf->SetFont($montserrat, '', 10);
$pdf->Cell(210, 35, $footerText, 0, 1, 'C', 1);

// Output the PDF
$pdf->Output('Internship_Offer_Letter.pdf', 'I');

?>
