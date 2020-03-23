<?php

namespace Controllers;

use Models\Invoice;
use Models\InvoiceDetail;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use TijsVerkoyen\CssToInlineStyles\CssToInlineStyles;


class InvoiceController extends BaseController
{
	public function list()
	{
		$invoices = Invoice::orderBy('created_at', 'desc')->get();
		return $this->render('admin.invoice.list', compact('invoices'));
	}
	function remove($id)
	{
		Invoice::destroy($id);
		header('location: ' . BASE_URL . 'admin/invoice/list');
		return false;
	}
	public function invoiceDetail($id)
	{
		$invoice = Invoice::find($id);
		if(!$invoice) {
			header('location: ' . BASE_URL . 'admin/invoice/list');
		}
		$products = InvoiceDetail::where('invoice_id', $id)->get();
		return $this->render('admin.invoice.invoice-detail', compact('invoice', 'products'));
	}
	public function sendMail($id)
	{
		$invoice = Invoice::find($id);
		$products = InvoiceDetail::where('invoice_id', $id)->get();

		$cssToInlineStyles = new CssToInlineStyles();
		$html = $this->parse('mail', compact('invoice', 'products'));
		$css = file_get_contents(__DIR__ . '/../public/css/mail.css');

		$content = $cssToInlineStyles->convert($html, $css);
		dd($content);

		$receiver = $invoice->customer_email;

		$subject = 'Your OnlinX Shopping order: ' . $invoice->id;

		$mail = new PHPMailer(true);
		try {
			$mail->SMTPDebug = SMTP::DEBUG_SERVER;
			$mail->CharSet = 'UTF-8';
			$mail->isSMTP();
			$mail->Host       = 'smtp.gmail.com';
			$mail->SMTPAuth   = true;
			$mail->Username = 'haond281099@gmail.com';
			$mail->Password = '28101999h';
			$mail->SMTPSecure = 'tls';
			$mail->Port = 587;
			$mail->setFrom('haond281099@gmail.com', 'haond');
			$mail->addAddress($receiver);
			$mail->isHTML(true);
			$mail->Subject = $subject;
			$mail->Body    = $content;
			$mail->send();
			echo 'Message has been sent';
		} catch (Exception $e) {
			echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}
	}
}
