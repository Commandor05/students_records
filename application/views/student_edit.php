<div class="col-sm-offset-2 col-sm-10">
    <h1>Edit student record:</h1>
</div>
<script language="JavaScript">

    function getData() {
        if ((document.upForm.name.value == '') || (document.upForm.lastName.value == '')) {
            alert('Fields "Name" and "Last name" must be completed')
        } else {
            document.location.href = 'http://' + document.location.host
            + '/students/update/id/' + document.upForm.id.value
            + '/name/' + document.upForm.name.value
            + '/lastName/' + document.upForm.lastName.value
            + '/gender/' + document.upForm.gender.value
            + '/age/' + document.upForm.age.value
            + '/faculty/' + document.upForm.faculty.value;
        }
    }
</script>

<form class="form-horizontal" action="students/update" method="post" name="upForm" role="form">
    <input type="hidden" name="id" value="<?= $this->row['id'] ?>"/>

    <div class="form-group">
        <label class="col-sm-2 control-label" for="name">Enter name</label>

        <div class="col-sm-4">
            <input type="text" class="form-control" placeholder="Name" id="name" name="name"
                   value="<?= $this->row['name'] ?>"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="lastName">Enter Last name</label>

        <div class="col-sm-4">
            <input type="text" class="form-control" placeholder="Last name" id="lastName" name="lastName"
                   value="<?= $this->row['lastName'] ?>"/>
        </div>
    </div>
    <div class="form-group">
        <label for="gender" class="col-sm-2 control-label">Select gender</label>

        <div class="col-sm-2">
            <select name="gender" id="gender" class="form-control">
                <option value="male">male</option>
                <option value="female" <?= ($this->row['gender'] == 'female') ? 'selected=true' : '' ?>>female</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="age" class="col-sm-2 control-label">Enter age</label>

        <div class="col-sm-2">
            <input type="text" id="age" name="age" class="form-control" placeholder="Age in decimal"
                   value="<?= $this->row['age'] ?>"/>
        </div>
    </div>
    <div class="form-group">
        <label for="faculty" class="col-sm-2 control-label">Enter age</label>

        <div class="col-sm-2">
            <select name="faculty" id="faculty" class="form-control">
                <option value="1">APP</option>
                <option value="2" <?= ($this->row['faculty'] == 2) ? 'selected=true' : '' ?>>MMT</option>
                <option value="3" <?= ($this->row['faculty'] == 3) ? 'selected=true' : '' ?>>GTR</option>
            </select>
        </div>
    </div>


    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <input type="button" class="btn btn-default" class="form-control"
                   value="Update"
                   onClick="getData()">
        </div>
    </div>
</form>



