<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Invoice List</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">List</a></li>
                                <li class="breadcrumb-item active">Invoice</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 message"><?php message(); ?></div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                      <form method="post">
                          <div class="card">
                              <!-- /.card-header -->
                              <div class="card-body">
                                  <div class="row">
                                    <?php if($this->common->get_particular('mst_general_settings',array('general_settings_name' => 'multiple_company'),'general_settings_value')==1){?>
                                        <?php if($this->session->userdata('access_level') <= 2) {  ?>
                                            <div class="form-group col-md-2">
                                                <label class="control-label">SELECT COMPANY</label>
                                                <select id="get_company_id" name="company_id" class="form-control form-control-danger">
                                                    <?php if($company_lists){ echo $company_lists; } ?>
                                                </select>
                                            </div>
                                        <?php } else{ ?>
                                            <div class="form-group col-md-2">
                                                <label class="control-label">SELECT COMPANY</label>
                                                <select id="get_company_id" name="company_id" class="form-control form-control-danger">
                                                    <?php if($company_lists){ echo $company_lists; } ?>
                                                </select>
                                            </div>

                                        <?php } ?>
                                    <?php } ?>
                                    <div class="form-group col-md-2">
                                        <label class="control-label">CUSTOMER TYPE</label>
                                        <select  name="customer_type" class="form-control select2" >
                                            <?php if($customer_type){ echo $customer_type; } ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="control-label">CUSTOMER NAME</label>
                                        <select  name="customer_id" class="form-control select2" >
                                            <?php if($customers){ echo $customers; } ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="control-label">FROM</label>
                                        <input type="date" name="date_from" class="form-control" placeholder="dd/mm/yyyy">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="control-label">TO</label>
                                        <input type="date" name="date_to" class="form-control" placeholder="dd/mm/yyyy">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="col-lg-12">&nbsp;</label>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="radio">VIEW
                                                    <input type="radio" name="option" value="view" <?php if(isset($option)){ if($option=='view'){ echo "checked";} }else{echo "checked";}?> >
                                                    <span class="checkround"></span>
                                                </label>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="radio">PDF
                                                    <input type="radio" name="option" value="print" <?php if(isset($option)){ if($option=='print'){ echo "checked";} }?> >
                                                    <span class="checkround"></span>
                                                </label>
                                            </div>
                                            <!-- <div class="col-md-4">
                                                <label class="radio">EXCEL
                                                    <input type="radio" name="option" value="excel" <?php if(isset($option)){ if($option=='excel'){ echo "checked";} }?> >
                                                    <span class="checkround"></span>
                                                </label>
                                            </div> -->
                                        </div>
                                    </div>
                                    <div class="form-group col-md-1">
                                        <label class="control-label">&nbsp;</label>
                                        <div class="col-md-12 float-lg-right">
                                            <input type="submit" class="btn btn-primary"  id='filter' value="FILTER">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <?php if($invoice_bills) { ?>
                        <div class="card-header">
                            <h3 class="card-title">GST SUMMARY</h3>
                        </div>
                        <div class="card-body">
                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th style="width: 50px">S.No</th>
                                        <th style="width: 150px">INVOICE DATE</th>
                                        <th>INVOICE NO</th>
                                        <th>CUSTOMER NAME</th>
                                        <th>GST NUMBER</th>
                                        <th style="text-align: center;">NET TOTAL</th>
                                        <th style="text-align: center;">TAX</th>
                                        <th>OTHER EXP</th>
                                        <th>TOTAL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($invoice_bills){
                                        $total_amount = 0;
                                        $total_gst = 0;
                                        $total = 0;
                                        $net_total = 0;
                                        $pre_total = 0;
                                        $before_tax = 0;
                                        foreach ($invoice_bills as $key => $list) {  
                                            $net_total = $list['invoice_loading_charges']+$list['invoice_transportaion_charges']+$list['invoice_other_expenses']-$list['invoice_cash_discount'];
                                            $pre_total = $pre_total + $net_total;
                                            if(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')== 1)){
                                                $before_tax = $list['new_total'] - $list['new_tax'];
                                                $total_amount  = $total_amount+ $before_tax;
                                                $total_gst     = $total_gst+$list['new_tax'];
                                                $total = $total_amount + $total_gst;
                                            }else{
                                                $before_tax = $list['new_total'];
                                                $total_amount  = $total_amount+ $before_tax;
                                                $total_gst     = $total_gst+ 0; 
                                                $total = $total_amount + $net_total;   
                                            }
                                            ?>
                                            <tr>
                                                <td><?php echo ($key+1); ?></td>
                                                <td><?php echo date('d-m-Y',strtotime($list['invoice_date']));?></td>
                                                <td><?php echo $list['invoice_number']; ?></td>
                                                <td><?php echo $list['customer_name']; ?></td>
                                                <td><?php echo $list['customer_gst']; ?></td>
                                                <td style="text-align: right;">&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia(($before_tax)); ?></td>
                                                <?php if(($this->common->get_particular('mst_invoice_settings',array('invoice_settings_name' => 'invoice_tax_included'),'invoice_settings_value')== 1)){ ?>
                                                    <td style="text-align: right;">&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($list['new_tax']); ?></td>
                                                <?php }else{ ?>
                                                    <td style="text-align: right;">&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia(0); ?></td>
                                                <?php } ?>
                                                <td style="text-align: right;">&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($net_total); ?></td>
                                                <td style="text-align: right;">&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia(($list['new_total'] + $net_total)); ?></td>
                                            </tr>
                                        <?php } } ?>
                                        <tr>
                                            <td colspan="5"><strong>GRAND TOTAL : </strong></td>
                                            <td style="text-align:right;"><b><?php if($total_amount!="") { echo MoneyFormatIndia($total_amount); } else{  echo "0.00"; } ?></b></td>
                                            <td style="text-align:right;"><b>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($total_gst); ?></b></td>
                                            <td style="text-align:right;"><b>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($pre_total); ?></b></td>
                                            <td style="text-align:right;"><b>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($total); ?></b></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        <?php }elseif($estimate_bills){ ?>
                            <div class="card-header">
                                <h3 class="card-title">ESTIMATE SUMMARY</h3>
                            </div>
                            <div class="card-body">
                                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th style="width: 50px">S.No</th>
                                            <th style="width: 150px">ESTIMATE DATE</th>
                                            <th>ESTIMATE NO</th>
                                            <th>CUSTOMER NAME</th>
                                            <th style="text-align: center;">NET TOTAL</th>
                                            <th>OTHER EXP</th>
                                            <th>TOTAL</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if($estimate_bills){
                                            $total_amount = 0;
                                            $total = 0;
                                            $net_total = 0;
                                            $before_tax = 0;
                                            $pre_total = 0;
                                            foreach ($estimate_bills as $key => $list) {  
                                                $net_total = $list['estimate_loading_charges']+$list['estimate_transportaion_charges']+$list['estimate_other_expenses']-$list['estimate_cash_discount'];
                                                $pre_total = $pre_total + $net_total;
                                                $before_tax = $list['new_total'];
                                                $total_amount  = $total_amount+ $before_tax;
                                                $total = $total_amount + $net_total;   
                                                ?>
                                                <tr>
                                                    <td><?php echo ($key+1); ?></td>
                                                    <td><?php echo date('d-m-Y',strtotime($list['estimate_date']));?></td>
                                                    <td><?php echo $list['estimate_number']; ?></td>
                                                    <td><?php echo $list['customer_name']; ?></td>
                                                    <td style="text-align: right;">&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia(($before_tax)); ?></td>
                                                    <td style="text-align: right;">&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($net_total); ?></td>
                                                    <td style="text-align: right;">&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia(($list['new_total'] + $net_total)); ?></td>
                                                </tr>
                                            <?php } } ?>
                                            <tr>
                                                <td colspan="4"><strong>GRAND TOTAL : </strong></td>
                                                <td style="text-align:right;"><b><?php if($total_amount!="") { echo MoneyFormatIndia($total_amount); } else{  echo "0.00"; } ?></b></td>
                                                <td style="text-align:right;"><b>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($pre_total); ?></b></td>
                                                <td style="text-align:right;"><b>&#8377;&nbsp;&nbsp;&nbsp;<?php echo MoneyFormatIndia($total); ?></b></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            <?php } ?>

                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
            </div>
        </div>
    </div>