<?php
    if ($this->session->flashdata('danger')) {
        echo '<div class="alert alert-danger fade show" role="alert">
                <div class="alert-text">'.$this->session->flashdata('danger').'</div>
            </div>';
    }
    unset($_SESSION['danger']);

    if ($this->session->flashdata('info')) {
        echo '<div class="alert alert-info fade show" role="alert">
                <div class="alert-text">'.$this->session->flashdata('info').'</div>
            </div>';
    }
    unset($_SESSION['info']);

    if ($this->session->flashdata('warning')) {
        echo '<div class="alert alert-warning fade show" role="alert">
                <div class="alert-text">'.$this->session->flashdata('warning').'</div>
            </div>';
    }
    unset($_SESSION['warning']);

    if ($this->session->flashdata('success')) {
        echo '<div class="alert alert-success fade show" role="alert">
                <div class="alert-text">'.$this->session->flashdata('success').'</div>
            </div>';
    }
    unset($_SESSION['success']);
