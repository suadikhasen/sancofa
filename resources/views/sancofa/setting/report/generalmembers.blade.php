@extends('sancofa.extends.setting')
@section('setting')
<div class="container">
	<div>{!! $general_report->container() !!}</div>
	<div>{!! $general_report->script() !!}</div>
</div>
<hr>
<div class="container  row">

	<div class="col-md-3">
	   <b class="text-info">Dailly Report</b>
	   <form method="get" action="{{route('Sancofa.Setting.DailyReport')}}" >
	   	
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
	   <form method="get" action="{{route('Sancofa.Setting.MonthlyReport')}}" >
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
	   <form method="get" action="{{route('Sancofa.Setting.YearlyReport')}}" >
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
@endsection
