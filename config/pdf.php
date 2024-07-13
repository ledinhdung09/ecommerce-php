<?php
require "./TCPDF-main/tcpdf.php";
function generateOrderPDF($firstname,$phone, $email,$address,$totalMoney,$last_order_id) {
    $pdf = new TCPDF();
    $pdf->SetTitle('Order Confirmation');
    $pdf->AddPage();
    $pdf->SetFont('dejavusans', '', 12);

    $pdf->Write(0, 'Xác nhận đơn hàng', '', 0, 'C', true, 0, false, false, 0);
    $pdf->Ln(10);
    $pdf->Write(0, 'Tên khách hàng: ' . $firstname, '', 0, 'L', true, 0, false, false, 0);
    $pdf->Write(0, 'Số điện thoại: ' . $phone, '', 0, 'L', true, 0, false, false, 0);
    $pdf->Write(0, 'Địa chỉ giao hàng: ' . $address, '', 0, 'L', true, 0, false, false, 0);
    $pdf->Write(0, 'Tổng số tiền thanh toán: ' . number_format($totalMoney, 0, '', '.')."VNĐ", '', 0, 'L', true, 0, false, false, 0);
    $pdf->Write(0, 'Email đặt hàng: ' . $email, '', 0, 'L', true, 0, false, false, 0);

    $filename = "don-hang-" . $last_order_id . ".pdf";
    $filePath = __DIR__ . '/order_pdf/' . $filename;
    $pdf->Output($filePath, 'F');
    return $filePath;
}
?>