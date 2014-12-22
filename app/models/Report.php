<?php

class Report extends Eloquent {

    protected $table = 'reports';
    protected $softDelete = true;

    protected $fillable = array(
        'id',
        'campaign_id',

        'sent',
        'received',
        'rejected',
        'opened'
    );

    public function usuario() {
        return $this->belongsTo('Campania', 'campaign_id', 'id');
    }

}
