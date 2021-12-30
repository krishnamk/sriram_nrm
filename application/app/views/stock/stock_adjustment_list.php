<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Stock Adjustment List</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">List</a></li>
                                <li class="breadcrumb-item active">Stock Adjustment</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
             <div class="row">
                <div class="col-lg-12 message"><?php message(); ?></div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="button-items" style="text-align: right;">
                                <a href="<?php echo base_url('stock_adjustment');?>" class="btn btn-primary waves-effect waves-light"><i class="bx bxs-comment-add font-size-16 align-middle mr-2"></i>Add Stock Adjustment</a>
                            </div><br>
                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Date</th>
                                        <th>Product Name</th>
                                        <th>Initial Qty</th>
                                        <th>Adjustment Qty</th>
                                        <th>Remarks</th>
                                        <!-- <th>Action</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($stock_adjustment){ 
                                        foreach($stock_adjustment as $key => $stock) { ?>
                                    <tr>
                                        <td><?php echo $key+1;?></td>
                                        <td><?php echo date('d-m-Y',strtotime($stock['date']));?></td>
                                        <td><?php $product_name = $this->common->get_particular('mst_products',array('product_id' => $stock['product_id']),'product_name'); echo $product_name;?></td>
                                        <td><?php echo $stock['initial_quantity'];?></td>
                                        <td><?php echo $stock['new_quantity'];?></td>
                                        <td><?php echo $stock['remarks'];?></td>
                                       <!--  <td>
                                            <a href="<?php echo base_url('colour_edit/'.$colour['stock_adjustment_id']);?>" class="btn btn-success"><i class="mdi mdi-comment-edit"></i></a>
                                        </td> -->
                                    </tr>
                                    <?php } }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div>
    </div>
</div>