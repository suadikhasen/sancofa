<?php $__env->startSection('setting'); ?>
<div class="container">
	<div><?php echo $general_report->container(); ?></div>
	<div><?php echo $general_report->script(); ?></div>
</div>
<hr>
<div class="container  row">

	<div class="col-md-3">
	   <b class="text-info">Dailly Report</b>
	   <form method="get" action="<?php echo e(route('Sancofa.Setting.DailyReport')); ?>" >
	   	
	   	  <div class="form-group  mr-3">
	   	  	 <label for="information"><b>select information: </b></label>
	         <select class="form-control" name="information" id="information">
	         	<option>newly registered member</option>
	         	<option>member who borrow book</option>
	         	<option>member who return book</option>
	         </select>
	   	  </div>
	   	  <div class="form-group">
	   	  	 <label for="day"><b>select last days</b></label>
	         <select class="form-control" name="day" id="day">
	         	<option>0</option>
	         	<option>1</option>
	         	<option>2</option>
	         	<option>3</option>
	         	<option>4</option>
	         	<option>5</option>
	         	<option>6</option>
	         	<option>7</option>
	         	<option>8</option>
	         	<option>9</option>
	         	<option>10</option>
	         	<option>11</option>
	         	<option>12</option>
	         	<option>13</option>
	         	<option>14</option>
	         	<option>15</option>
	         	<option>16</option>
	         	<option>17</option>
	         	<option>18</option>
	         	<option>19</option>
	         	<option>20</option>
	         	<option>21</option>
	         	<option>22</option>
	         	<option>23</option>
	         	<option>24</option>
	         	<option>25</option>
	         	<option>26</option>
	         	<option>26</option>
	         	<option>27</option>
	         	<option>28</option>
	         	<option>29</option>
	         </select>
	   	  </div>
	   	  <button class="btn btn-success" type="submit">generate</button>
	   </form>
   </div>

   <div class="col-md-3">
	   <b class="text-success">Monthly Report</b>
	   <form method="get" action="<?php echo e(route('Sancofa.Setting.MonthlyReport')); ?>" >
	   	  <div class="form-group  mr-3">
	   	  	 <label for="information"><b>select information: </b></label>
	         <select class="form-control" name="information" id="information">
	         	<option>newly registered member</option>
	         	<option>member who borrow book</option>
	         	<option>member who return book</option>
	         </select>
	   	  </div>
	   	  <button class="btn btn-success" type="submit">generate</button>
	   </form>
   </div>

   <div class="col-md-3">
	   <b class="text-primary">Yearly Report</b>
	   <form method="get" action="<?php echo e(route('Sancofa.Setting.YearlyReport')); ?>" >
	   	  <div class="form-group  mr-3">
	   	  	 <label for="information"><b>select information: </b></label>
	         <select class="form-control" name="information" id="information">
	         	<option>newly registered member</option>
	         	<option>member who borrow book</option>
	         	<option>member who return book</option>
	         </select>
	   	  </div>

	   	  <button class="btn btn-success" type="submit">generate</button>
	   </form>
   </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('sancofa.extends.setting', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sankofa/lampstack-7.3.11-0/apache2/htdocs/Sankofa/resources/views/sancofa/setting/report/generalmembers.blade.php ENDPATH**/ ?>