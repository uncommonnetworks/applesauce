<?php

use Carbon\Carbon;

class StrikeController extends Controller {

    public function deleteWarning($id)
    {
        $warning = Warning::findOrFail($id);

    }

}
?>