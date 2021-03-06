<!-- Trang index của Bảng hình thức thanh toán -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Backend | Bảng hình thức thanh toán</title>
    <?php include_once(__DIR__.'/../../layouts/styles.php'); ?>
    <?php include_once(__DIR__.'/../../layouts/style_data.php'); ?>
</head>
<body>
    <!-- Header -->
    <?php include_once(__DIR__.'/../../layouts/partials/header.php'); ?>
    <!-- End header -->
    <!-- Container -->
    <div class="container-fluid my-5">
        <div class="row">
            <div class="col-md-3">
                <?php include_once(__DIR__.'/../../layouts/partials/sidebar.php'); ?>
            </div>
            <div class="col-md-9">
                <h1 class="text-center">Hình thức thanh toán</h1>
                    <?php
                        include_once(__DIR__ . '/../../../dbconnect.php');

                        $sql = " SELECT httt_ma,httt_ten FROM hinhthucthanhtoan;";
                        $result = mysqli_query($conn, $sql);
                        $data = [];
                        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                            $data[] = array(
                                'httt_ma' => $row['httt_ma'],
                                'httt_ten' => $row['httt_ten'],
                            );
                        }

                    ?>
                    <div class="text-center">
                        <a href="create.php" class="btn btn-dark my-3"><i class="fa fa-plus-circle" aria-hidden="true"></i> Thêm mới</a>
                    </div>
                    <table class="table table-hover table-striped text-center table-responsive-sm" name="tbl" id="tbl">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Mã Hình thức Thanh toán</th>
                                <th>Tên Hình thức Thanh toán</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1 ?>
                            <?php foreach($data as $httt): ?>
                            <tr>
                                <td class="align-middle"><?= $i++ ?></td>
                                <td class="align-middle"><?= $httt['httt_ma']; ?></td>
                                <td class="font-weight-bold align-middle"><?= $httt['httt_ten']; ?></td>
                                <td class="align-middle">
                                    <button class="btn btn-danger btnDelete" data-httt_ma="<?= $httt['httt_ma'] ?>" data-httt_ten="<?= $httt['httt_ten'] ?>" data-toggle="tooltip" data-placement="top" title="Xóa"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                    <a class="btn btn-success" href="edit.php?httt_ma=<?= $httt['httt_ma']; ?>" data-toggle="tooltip" data-placement="top" title="Sửa"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    </div>
        </div>
    </div>

    <!-- End container -->
    <!-- Footer -->
    <?php include_once(__DIR__.'/../../layouts/partials/footer.php'); ?>
    <!-- End footer -->
    <?php include_once(__DIR__.'/../../layouts/scripts.php'); ?>
    <?php include_once(__DIR__.'/../../layouts/script_data.php'); ?>
    <script src="/backend/assets/vendor/sweetalert/sweetalert.min.js"></script>
    <script>
        $(document).ready(function(){
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })
            $('.btnDelete').click(function(){
                var temp = $(this).data('httt_ten');
                swal({
                    title: "Bạn muốn xóa " + temp,
                    text: "dữ liệu sẽ không thể phục hồi sau khi xóa.",
                    icon: "warning",
                    buttons: ["Hủy","Xóa"],
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        var httt_ma = $(this).data('httt_ma');
                        var url = "delete.php?httt_ma=" + httt_ma;
                        location.href = url;
                    } else {
                        swal({
                            title: "Đã hủy hành động xóa",
                            button: 'Đã hiểu',
                            icon: 'info',
                        });
                    }
                });
            });
            var table = $('#tbl').DataTable({
                dom: "<'row'<'col-md-12 text-center'B>><'row'<'col-md-6'l><'col-md-6'f>><'row'<'col-sm-12'tr>><'row'<'col-md-6'i><'col-md-6'p>>",
                buttons: [
                    'copy', 'excel', 'pdf'
                ],
                language: {
                    "url": "../../../assets/vendor/DataTables/Vietnamese.json",
                    buttons: {
                        "copy": "Sao chép",
                        "excel": "Xuất ra file Excel",
                        "pdf": "Xuất ra file PDF",
                    }
                }
            });
        });
    </script>
</body>
</html>
