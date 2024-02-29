<?php include '../app/views/templates/header.php'; ?>
<div class="col-md-6" style="margin-left: 300px;">
    <div class="card card-primary">
        <div class="card-body">
            <?php foreach ($data as $ulasan) : ?>
            <form action="<?= urlTo('/ulasan/'.$ulasan['UlasanID'].'/update'); ?>" method="post">
                <div class="form-group">
                    <label for="Ulasan">Ulasan</label>
                    <textarea id="Ulasan" name="Ulasan" class="form-control"
                        required><?= $ulasan['Ulasan']; ?></textarea>
                </div>

                <div class="form-group">
                    <label for="Rating">Rating</label>
                    <input type="number" id="Rating" name="Rating" class="form-control"
                        value="<?= $ulasan['Rating']; ?>" required>
                </div>

                <div class="form-group">
                    <a href="<?= urlTo('/perpustakaan/'.$ulasan['BukuID'].'/detailbuku'); ?>"
                        class="btn btn-danger">Batal</a>
                    <button type="submit" class="btn btn-primary float-right">Edit Ulasan</button>
                </div>
            </form>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php include '../app/views/templates/footer.php'; ?>