<?php
  include ($_SERVER['DOCUMENT_ROOT'] . 'Aula06/lib/fpdf/fpdf.php');
  include ($_SERVER['DOCUMENT_ROOT'] . 'Aula06/classes/usuarios.php');
  include ($_SERVER['DOCUMENT_ROOT'] . 'Aula06/DAO/usuariosDAO.php');
  include ($_SERVER['DOCUMENT_ROOT'] . 'Aula06/classes/perfis.php');
  include ($_SERVER['DOCUMENT_ROOT'] . 'Aula06/DAO/perfisDAO.php');

  $usuario = new usuarios();
  $todos_usuarios = new usuariosDAO($usuario);
  $perfis = new perfis();
  $todos_perfis = new perfisDAO();

  $todos_usuarios = $todos_usuarios->findAll();

  $relatorio_pdf = new FPDF();
  $relatorio_pdf->AddPage();
  $relatorio_pdf->SetFont('Arial','B',16);
  $relatorio_pdf->Cell(189,10,utf8_decode('Relatório dos usuários cadastrados'),0,0,'C');
  $relatorio_pdf->Ln(15);

  $relatorio_pdf->SetFont('Arial','I',12);
  $relatorio_pdf->Cell(63,7,'Nome',1,0,'C');
  $relatorio_pdf->Cell(63,7,'E-mail',1,0,'C');
  $relatorio_pdf->Cell(63,7,utf8_decode('Perfil do usuário'),1,0,'C');
  $relatorio_pdf->Ln();

  foreach ($todos_usuarios as $key => $usuario ) {
    $relatorio_pdf->Cell(63,7,$usuario->nome,1,0,'L');
    $relatorio_pdf->Cell(63,7,$usuario->email,1,0,'L');
    $perfis = $todos_perfis->find($usuario->id_perfis);
    $relatorio_pdf->Cell(63,7,$perfis[0]->nome,1,0,'C');
    $relatorio_pdf->Ln();
  }

  $relatorio_pdf->Output();
?>
