<template>
    <div class="container">

      <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">

        <!-- <div class="text-sm text-danger">
            <p><small>{{}}</small></p>
        </div> -->
        <div class="form-group">
            <label>Name </label>
            <input type="text" v-model="form.name" required class="form-control"/>
        </div>
        <div class="form-group">
            <label>Email </label>
            <input type="text" v-model="form.email" required class="form-control" />
        </div>
        <div class="form-group">
            <label>Phone </label>
            <input type="text" v-model="form.phone" required class="form-control" />
        </div>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
        <div class="">
            <button v-if="emp_id ==''" type="button" class="btn btn-success" @click="storeEmployee">Submit</button>

            <button v-else type="button" @click="updateEmployee" class="btn btn-primary">Update</button>

        </div>
      </div>
    </div>
  </div>
</div>
        <table class="table">
  <thead>
    <tr>
      <th scope="col">S.No</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Phone</th>
      <th scope="col">Action</th>

    </tr>
  </thead>
  <tbody>
    <template v-for="employee in employees" :key="employee.id">
    <tr>
      <th scope="row">{{employee.id}}</th>
      <td>{{employee.name}}</td>
      <td>{{employee.email}}</td>
      <td>{{employee.phone}}</td>
      <td>
        <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#exampleModal" @click="editEmployee(employee)">Edit</button>
        <button class="btn btn-sm btn-danger" data-toggle="modal"  @click="deleteEmployee(employee.id)">Delete</button>

      </td>
    </tr>
    </template>
  </tbody>
</table>

</div>
</template>
<script>
// alert('dsdsdsd');
import { ref,reactive, onMounted } from 'vue';
import axios from 'axios';
export default{
    setup() {
        const employees = ref([]);
        const emp_id = ref([]);

        const storeEmployee = async() => {
            try{
                await axios.post('api/employees',form)
                getEmployee();
                $("#modal").modal('hide');

            }catch(e){
                alert(e);
            }
        }

        const deleteEmployee = async(id)=>{
            // alert(id);
            let del = await axios.delete('api/employee/'+id)
            getEmployee();
        }

        const updateEmployee = async()=>{

            try{
                await axios.patch('api/employee/'+ emp_id.value, form)
                getEmployee();
                $("#modal").modal('hide');
            }catch(e)
            {
                alert(e);

            }
        }

        const form = reactive({
          name :'',
          phone :'',
          email: ''
        });

        const getEmployee = async() => {
            let res = await axios.get('api/employees');
            employees.value = res.data;

        }

        const editEmployee = (employee) => {
            // $("#modal").modal('show');
            emp_id.value = employee.id
            form.name = employee.name;
            form.email = employee.email;
            form.phone = employee.phone;

        }

        onMounted(getEmployee());

        return {
            employees,
            storeEmployee,
            form,
            editEmployee,
            emp_id,
            updateEmployee,
            deleteEmployee
        }
    }
}

</script>
