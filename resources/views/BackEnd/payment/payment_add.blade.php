@extends('BackEnd.dashboard')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Form elements</a> <a href="#" class="current">Validation</a> </div>
    <h1>Payment Add</h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Payment Add</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="#" name="basic_validate" id="basic_validate" novalidate="novalidate">
              <div class="control-group">
              <label class="control-label">Select Block/wing</label>
              <div class="controls">
                <select>
                  <option>a</option>
                  <option>b</option>
                  <option>c</option>
                  
                </select>
              </div>
            </div>
                 <div class="control-group">
              <label class="control-label">Select Charges type</label>
              <div class="controls">
                <select>
                  <option>maintenes</option>
                  <option>other</option>
                </select>
                  
              </div>
             
            </div>
                <div class="control-group">
              <label class="control-label">Member</label>
              <div class="controls">
                <select>
                  <option>member1</option>
                  <option>member2</option>
                  <option>member3</option>
                  <option>member4</option>
                  <option>member5</option>
                  <option>member6</option>
                      
                </select>
                  
              </div>
             
            </div>
                <div class="control-group">
                <label class="control-label">Amount</label>
                <div class="controls">
                  <input type="text" name="required" id="required">
                </div>
              </div>
                 <div class="control-group">
              <label for="normal" class="control-label">Date</label>
              <div class="controls">
                <input type="text" id="mask-date" class="span8 mask text">
                <span class="help-block blue span8">99/99/9999</span> </div>
            </div>
              <div class="form-actions">
                <input type="submit" value="submit" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    
  </div>
</div>
@stop