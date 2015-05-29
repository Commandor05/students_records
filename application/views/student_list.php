<p>Students list:</p>
<table class="table table-hover">
    <tr>
        <th>Name
        </td>
        <th>Last Name
        </td>
        <th>Gender
        </td>
        <th>Age
        </td>
        <th>Faculty
        </td>
        <th>
        </td>
        <th>
        </td>
    </tr>
    <?php
    foreach ($this->rec as $item) {
        $id = $item['id'];
        $name = $item['name'];
        $lastName = $item['lastName'];
        $gender = $item['gender'];
        $age = $item['age'];
        $faculty = $item['faculty'];

        echo <<<LABEL

		    <tr>
			    <td>$name</td>
			    <td>$lastName</td>
			    <td>$gender</td>
			    <td>$age</td>
			    <td>$faculty</td>
		        <td><a href="/students/del/id/$id">

                        <span class="glyphicon glyphicon-remove"></span>DEL

                </a></td>
		        <td><a href="/students/edit/id/$id">

                        <span class="glyphicon glyphicon-pencil"></span>EDIT

		        </a></td>
		    </tr>

LABEL;
    }

    ?>
</table>