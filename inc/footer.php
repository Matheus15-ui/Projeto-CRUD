            <hr>
        </main> <!-- /container -->
        
        <?php include(COOKIE_TEMPLATE);?> 
        
        <footer class="container">
            <?php $data=new DateTime ("now",  new DateTimeZone("America/Sao_Paulo"))?>
            <p>&copy;2025 á <?php echo $data ->format("Y"); ?>- Matheus Vinicius e Arthur Santos</p>
        </footer>

        <script src="<?php echo BASEURL; ?>js/jquery-3.7.1.min.js"></script>   
        <script src="<?php echo BASEURL; ?>js/awesome/all.min.js"></script>
        <script src="<?php echo BASEURL; ?>js/bootstrap/bootstrap.bundle.min.js"></script>
        <script src="<?php echo BASEURL; ?>js/main.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.0.3/jquery.mask.min.js"></script>
    </body>
</html>