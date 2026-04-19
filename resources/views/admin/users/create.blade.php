<form method="POST" action="{{ route('admin.users.store') }}">
    @csrf

    <input name="name" placeholder="Name"><br><br>

    <input name="email" placeholder="Email"><br><br>

    <input name="password" type="password" placeholder="Password"><br><br>

    <!-- ROLE -->
    <select id="role" name="role_id">
        @foreach($roles as $role)
            <option value="{{ $role->id }}" data-role="{{ $role->role_name }}">
                {{ $role->role_name }}
            </option>
        @endforeach
    </select>

    <br><br>

    <!-- DEPARTMENTS -->
    <div id="departmentBox">
        <label>Departments</label><br>

        <select id="departmentSelect"
                name="department_ids[]"
                multiple>
            @foreach($departments as $department)
                <option value="{{ $department->id }}">
                    {{ $department->department_name }}
                </option>
            @endforeach
        </select>
    </div>

    <br>

    <button type="submit">Create User</button>
</form>


<script>
const roleSelect = document.getElementById('role');
const departmentSelect = document.getElementById('departmentSelect');

function updateDepartmentMode() {
    const selectedOption = roleSelect.options[roleSelect.selectedIndex];
    const roleName = selectedOption.dataset.role;

    // RESET selection every time role changes
    departmentSelect.selectedIndex = -1;

    if (roleName === 'HoD' || roleName === 'Student') {
        departmentSelect.removeAttribute('multiple');
    } else {
        departmentSelect.setAttribute('multiple', 'multiple');
    }
}

// run on change
roleSelect.addEventListener('change', updateDepartmentMode);

// run on page load (VERY IMPORTANT)
updateDepartmentMode();
</script>