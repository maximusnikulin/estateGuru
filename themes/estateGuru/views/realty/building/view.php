<?php
/** @var Building $data */
if ($data->status == STATUS_HOME) {
    $this->renderPartial('/building/view-home', ['data' => $data]);
}
if ($data->status == STATUS_EARTH) {
    $this->renderPartial('/building/view-earth', ['data' => $data]);
}
if ($data->status == STATUS_COTTAGE) {
    $this->renderPartial('/building/view-cottage', ['data' => $data]);
}
if ($data->status == STATUS_COMMERCIAL) {
    $this->renderPartial('/building/view-commercial', ['data' => $data]);
}
?>