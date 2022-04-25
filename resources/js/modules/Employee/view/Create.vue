<template>
<div class="card w-100 full-height d-flex align-items-stretch" data-aos="zoom-in">
    <div class="card-header">
        <h5 class="card-title">{{ pagename }}</h5>
    </div>
    
<form @submit.prevent="handleSubmit" @keydown="form.onKeydown($event)" enctype="multipart/form-data">
    <div class="card-body">
        <div class="" data-aos="zoom-in">
            <label class="labels h5 fw-bold">Personal Information</label>
            <div class="clearfix">
                <div class="d-flex flex-column align-items-center text-center p-3 col-md-2 float-md-start">
                    <img class="rounded-circle" width="150px"  height="150px" :src="url?url:'https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg'">
                    <span class="font-weight-bold">{{form.lastname?form.lastname:'Doe'}}, {{form.firstname?form.firstname:'John'}}</span>
                    <span class="text-black-50">{{form.email?form.email:'john.doe@mail.com'}}</span><span></span>
                    <div v-if="!url">
                            <input type="file" class="form-control" v-on:change="onChange">
                    </div>
                    <div class="" v-else>
                    <span class="badge bg-success">{{form.file.name}} 
                    <button @click="handleDelete" type="button" class="btn-close btn-close-white btn-sm" aria-label="Close"></button></span> 
                    </div> 
                            <HasError :form="form" field="file" /> 
                </div>

                <div class="row mt-2">
                    <div class="col-md-6 mb-3"><label class="labels">Last Name</label>
                    <input type="text" v-model="form.lastname" class="form-control" placeholder="Last Name" value=""> 
                            <HasError :form="form" field="lastname" /> 
                    </div>
                    <div class="col-md-6 mb-3"><label class="labels">First Name</label>
                    <input type="text" v-model="form.firstname" class="form-control" value="" placeholder="First Name">
                            <HasError :form="form" field="firstname" /> 
                    </div>
                    <div class="col-md-6 mb-3"><label class="labels">Middle Name</label>
                    <input type="text" v-model="form.middlename" class="form-control" value="" placeholder="Middle Name">
                            <HasError :form="form" field="middlename" /> 
                    </div>
                    <div class="col-md-6 mb-3"><label class="labels">Suffix Name</label>
                    <input type="text" v-model="form.suffix" class="form-control" value="" placeholder="Suffix Name">
                            <HasError :form="form" field="suffix" /> 
                    </div>
                    <div class="col-md-3 mb-3"><label class="labels">Birthdate</label>
                    <input type="date" v-model="form.birthdate" class="form-control" value="" placeholder="Birthdate">
                            <HasError :form="form" field="birthdate" /> 
                    </div>
                    <div class="col-md-3 mb-3"><label class="labels">Civil Status</label>
                    <select class="form-select" v-model="form.civilstatus">
                        <option selected disabled>Select civil status</option>
                      <option v-for="(data,i ) in mFetchLookup('CIVIL')" :key="i" v-bind:value="data.lookup" >{{ data.fulltitle }}</option> 
                    </select>
                            <HasError :form="form" field="civilstatus" /> 
                    </div>
                    <div class="col-md-3 mb-3"><label class="labels">Gender</label>
                     <select class="form-select" v-model="form.gender">
                        <option selected disabled>Select gender</option>
                      <option v-for="(data,i ) in mFetchLookup('GENDER')" :key="i" v-bind:value="data.lookup" >{{ data.fulltitle }}</option> 
                            <HasError :form="form" field="gender" /> 
                    </select>
                    </div>
                    <div class="col-md-3 mb-3"><label class="labels">Religion</label>
                    <input type="text" v-model="form.religion" class="form-control" value="" placeholder="Religion">
                            <HasError :form="form" field="religion" /> 
                    </div>
                    <div class="col-md-3 mb-3"><label class="labels">Mobile</label>
                    <input type="text" v-model="form.mobile" class="form-control" value="" placeholder="Mobile">
                            <HasError :form="form" field="mobile" /> 
                    </div>
                    <div class="col-md-3 mb-3"><label class="labels">Email Address</label>
                    <input type="text" v-model="form.email" class="form-control" value="" placeholder="Email Address">
                            <HasError :form="form" field="email" /> 
                    </div>
                  
                </div>
            </div>
            <hr>
            <div class="" data-aos="zoom-in">
             
                <label class="labels h5 fw-bold">Address Information</label>
                <div class="row mt-2" data-aos="zoom-out"  v-for="(data,i) in getAddress" :key="i">
                    
                    <label class="labels fw-bold">{{i==0?'Present':'Current'}} Address</label>
                    <div class="col-md-3 mb-3"><label class="labels">Region</label>
                    <input type="text" v-model="form.address[i].region" class="form-control" placeholder="Region" value="">
                            <HasError :form="form" :field="`address.${i}.region`" /> 
                    </div>
                    <div class="col-md-3 mb-3"><label class="labels">Province</label>
                    <input type="text" v-model="form.address[i].province" class="form-control" placeholder="Province" value="" :disabled="isNull(form.address[i].region)">
                            <HasError :form="form" :field="`address.${i}.province`" /> 
                    </div>
                    <div class="col-md-3 mb-3"><label class="labels">City/Municipal</label>
                    <input type="text" v-model="form.address[i].citymuni" class="form-control" placeholder="City/Municipal" value="" :disabled="isNull(form.address[i].province)">
                            <HasError :form="form" :field="`address.${i}.citymuni`" /> 
                    </div>
                    <div class="col-md-3 mb-3"><label class="labels">Barangay</label>
                    <input type="text" v-model="form.address[i].brgy" class="form-control" placeholder="Barangay" value="" :disabled="isNull(form.address[i].citymuni)">
                            <HasError :form="form" :field="`address.${i}.brgy`" /> 
                    </div>
                    <div class="col mb-3"><label class="labels">Address</label>
                    <input type="text" v-model="form.address[i].address" class="form-control" placeholder="Address" value="" :disabled="isNull(form.address[i].brgy)">
                            <HasError :form="form" :field="`address.${i}.address`" /> 
                    </div>

                </div>
               
                
                <button type="button" class="btn btn-sm btn-outline-success" @click="handleCopy" :disabled="isNull(form.address[0].address)">Copy</button>
            </div>
            <hr>
            <div class="">
                <label class="labels h5 fw-bold">Job Information</label>
                <div class="row mt-2">
                    <div class="col-md-4 mb-3"><label class="labels">Emp ID</label>
                    <input type="text" :value="serial"
   @input="form.emp_number = $event.target.value" class="form-control" placeholder="Emp ID">
                            <HasError :form="form" field="emp_number" /> 
                    </div>
                    <div class="col-md-4 mb-3"><label class="labels">Position</label>
                    <select class="form-select" v-model="form.position">
                        <option selected disabled>Select Position</option>
                      <option v-for="(data,i ) in mFetchLookup('POST00')" :key="i" v-bind:value="data.lookup" >{{ data.fulltitle }}</option> 
                    </select>
                            <HasError :form="form" field="position" />  
                    </div>
                    <div class="col-md-4 mb-3"><label class="labels">Department</label>
                    <select class="form-select" v-model="form.department">
                        <option selected disabled>Select Position</option>
                      <option v-for="(data,i ) in mFetchLookup('DEPT00')" :key="i" v-bind:value="data.lookup" >{{ data.fulltitle }}</option> 
                    </select>
                            <HasError :form="form" field="department" />  
                    </div>
                    <div class="col-md-4 mb-3"><label class="labels">Date hired</label>
                    <input type="text" class="form-control" placeholder="Date hired" value="">
                            <HasError :form="form" field="file" /> 
                    </div>
                    <div class="col-md-4 mb-3"><label class="labels">Type of Employement</label>
                    <select class="form-select" v-model="form.emptype"> 
                      <option v-for="(data,i ) in mFetchLookup('EMPTYP')" :key="i" v-bind:value="data.lookup" >{{ data.fulltitle }}</option> 
                    </select>
                            <HasError :form="form" field="department" />   
                    </div>
                    <div class="col-md-4 mb-3"><label class="labels">Employee Status</label>
                    <select class="form-select" v-model="form.empstt">
                        <option selected disabled>Select Position</option>
                      <option v-for="(data,i ) in mFetchLookup('EMPSTT')" :key="i" v-bind:value="data.lookup" >{{ data.fulltitle }}</option> 
                    </select>
                            <HasError :form="form" field="empstt" />  
                    </div>

                </div>

            </div>

            <hr>
            <div class="">
                <label class="labels h5 fw-bold">ID's</label>
                <div class="row mt-2">
                    <div class="col-sm-12 col-lg mb-3"><label class="labels">TIN</label>
                    <input type="text" class="form-control" placeholder="TIN" value="">
                            <HasError :form="form" field="file" /> 
                    </div>
                    <div class="col-sm-12 col-lg mb-3"><label class="labels">SSS</label>
                    <input type="text" class="form-control" placeholder="SSS" value="">
                            <HasError :form="form" field="file" /> 
                    </div>
                    <div class="col-sm-12 col-lg mb-3"><label class="labels">GSIS</label>
                    <input type="text" class="form-control" placeholder="GSIS" value="">
                            <HasError :form="form" field="file" /> 
                    </div>
                    <div class="col-sm-12 col-lg mb-3"><label class="labels">PhilHealth</label>
                    <input type="text" class="form-control" placeholder="PhilHealth" value="">
                            <HasError :form="form" field="file" /> 
                    </div>
                    <div class="col-sm-12 col-lg mb-3"><label class="labels">Pag-Ibig</label>
                    <input type="text" class="form-control" placeholder="Pag-Ibig" value="">
                            <HasError :form="form" field="file" /> 
                    </div>

                </div>

            </div>
            <hr>
            <div class="row">
                <label class="labels h5 fw-bold">Pay</label>
                <div class="row mt-2">
                    <div class="card-group">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6 mb-3 row">
                                        <label for="inputSalaryPay" class="col-sm-4 col-form-label">Frequency</label>
                                        <div class="col-sm-8">
                                           <select class="form-select" aria-label="Default select example">
                                              <option selected>Be-Weekly</option>
                                              <option value="1">One</option>
                                              <option value="2">Two</option>
                                              <option value="3">Three</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-3 row">
                                        <label for="inputSalaryPay" class="col-sm-4 col-form-label">Salary Pay</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="inputSalaryPay">
                                        </div>
                                    </div>
                                    
                                     <div class="col-6 mb-3 row">
                                        <label for="inputSalaryPay" class="col-sm-4 col-form-label">Method</label>
                                        <div class="col-sm-8">
                                            <select class="form-select" aria-label="Default select example">
                                              <option selected>Check</option>
                                              <option value="1">One</option>
                                              <option value="2">Two</option>
                                              <option value="3">Three</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-3 row">
                                        <label for="inputSalaryPay" class="col-sm-4 col-form-label">Account</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="inputSalaryPay">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body pt-0">
                                <table class="table table-sm caption-top table-bordered">
                                    <caption>Pay Rates</caption>
                                    <thead>
                                        <tr>
                                            <th>Pay Type</th>
                                            <th>Rate</th>
                                            <th class="text-center" style="width:80px">Active</th>
                                            <th>Default</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Bonus</td>
                                            <td></td>
                                            <td class="text-center"><i class="fa fa-check" aria-hidden="true"></i></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Holiday</td>
                                            <td></td>
                                            <td class="text-center"><i class="fa fa-check" aria-hidden="true"></i></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Overtime</td>
                                            <td></td>
                                            <td class="text-center"><i class="fa fa-check" aria-hidden="true"></i></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Regular</td>
                                            <td></td>
                                            <td class="text-center"><i class="fa fa-check" aria-hidden="true"></i></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Vacation</td>
                                            <td></td>
                                            <td class="text-center"><i class="fa fa-check" aria-hidden="true"></i></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <br><br><br><br><br>
        </div>

    </div>
    <div class="card-footer ">
       <button class="btn btn-primary" type="submit" :loading="form.busy" :disabled="form.busy">
    Submit
  </button>  
    </div>
    </form>
</div>
</template>

<script>
import bus from "../../../EventBus"
import store from "~/store";
import Form from "vform";
export default {
    name: "EmployeeCreate",
    middleware: "auth",
    layout: "auth",
    data() {
        return {
            pagename: "Employee",
            data: [],
            url:'',
            description: "", 
            form: new Form({
                trnmode: '',
                trntype: '',
                file:null, 
                branch_id:'',
                emp_number:'',
                lastname:'',
                firstname:'',
                middlename:'',
                suffix:'',
                birthdate:'',
                email:'',
                mobile:'',
                religion:'',
                civilstatus:'',
                gender:'',
                status:'',
                image:'',
                datehired:'',
                position:'',
                department:'',
                type:'', 
                address:[],
            }),
        };

    },
    metaInfo() {
        return {
            title: this.pagename
        };
    },
    mounted() {
        this.hasAccess("employee-create");
        this.$store.dispatch("MenuName", {
            menuname: ['Employee', 'Create']
        });
    
            this.getEmpnumber; 
        this.onLoad();

    },
    methods: {
    handleCopy(){
        this.form.address[1].region = this.form.address[0].region;
        this.form.address[1].province = this.form.address[0].province;
        this.form.address[1].citymuni = this.form.address[0].citymuni;
        this.form.address[1].brgy = this.form.address[0].brgy;
        this.form.address[1].region = this.form.address[0].region;
    },
    handleDelete(){
        this.url='';
    },
     onChange(e) {
                this.form.file = e.target.files[0];
               
                const file = e.target.files[0];
                this.url = URL.createObjectURL(file);
      
                
            },
        handleSubmit(){
            // this.form.trnmode = 'storeEmployee';
            // this.form.trntype = 'store';
            // this.form.post('/api/auth/employee').then((res) =>{
            //     console.log(res.data);
            // })
            console.log(this.form);
        },
        onLoad() {
            
            
            
            // this.form.emp_number = this.serial;
        }

    },
    computed: {
        getEmpnumber(){
            this.$store.dispatch("Serial/fetchSerial", {
                trnmode: "fetchSerial",
                trntype: "fetch",
                branch: this.isUser.company.branch,
                key: "EMPLOYEE",
            });
        },
        getAddress(){
            let address = [];
            for (let i = 0; i < 2; i++) {
                this.form.address.push({region:'',province:'',citymuni:'',brgy:'',address:''});
                address.push({region:'',province:'',citymuni:'',brgy:'',address:''})
            }
            return address;
        },
        getRate(){
        
        }
    }

}
</script>

<style lang="scss" scoped>
.file-upload {
    background-color: #ffffff;
    width: 600px;
    margin: 0 auto;
    padding: 20px;
}

.file-upload-btn {
    width: 100%;
    margin: 0;
    color: #fff;
    background: #1FB264;
    border: none;
    padding: 10px;
    border-radius: 4px;
    border-bottom: 4px solid #15824B;
    transition: all .2s ease;
    outline: none;
    text-transform: uppercase;
    font-weight: 700;
}

.file-upload-btn:hover {
    background: #1AA059;
    color: #ffffff;
    transition: all .2s ease;
    cursor: pointer;
}

.file-upload-btn:active {
    border: 0;
    transition: all .2s ease;
}

.file-upload-content {
    display: none;
    text-align: center;
}

.file-upload-input {
    position: absolute;
    margin: 0;
    padding: 0;
    width: 100%;
    height: 100%;
    outline: none;
    opacity: 0;
    cursor: pointer;
}

.image-upload-wrap {
    margin-top: 20px;
    border: 4px dashed #1FB264;
    position: relative;
}

.image-dropping,
.image-upload-wrap:hover {
    background-color: #1FB264;
    border: 4px dashed #ffffff;
}

.image-title-wrap {
    padding: 0 15px 15px 15px;
    color: #222;
}

.drag-text {
    text-align: center;
}

.drag-text h3 {
    font-weight: 100;
    text-transform: uppercase;
    color: #15824B;
    padding: 60px 0;
}

.file-upload-image {
    max-height: 200px;
    max-width: 200px;
    margin: auto;
    padding: 20px;
}

.remove-image {
    width: 200px;
    margin: 0;
    color: #fff;
    background: #cd4535;
    border: none;
    padding: 10px;
    border-radius: 4px;
    border-bottom: 4px solid #b02818;
    transition: all .2s ease;
    outline: none;
    text-transform: uppercase;
    font-weight: 700;
}

.remove-image:hover {
    background: #c13b2a;
    color: #ffffff;
    transition: all .2s ease;
    cursor: pointer;
}

.remove-image:active {
    border: 0;
    transition: all .2s ease;
}
</style>
