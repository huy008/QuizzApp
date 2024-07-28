<script setup>
import Layout from "@/Shared/Layout.vue";
import NewQuestionModal from "@/Shared/NewQuestionModal.vue";
import {router,usePage} from '@inertiajs/vue3';
import { ref,computed } from "vue";


const  page = usePage()
const success = computed(()=>page.props.flash.success)
const showNewQuestionModal = ref(false);
const createdQuestion = ref(null);
const selectedAnswer = ref(null);
const newAnswers = ref([]);
let answerId = 1


function createQuestion() {
    showNewQuestionModal.value = true;
}
function destroyModal() {
    showNewQuestionModal.value = false;
}
function addNewAnswer(){
     const newAnswer = {
          id:answerId++,
          answer :'',
          correct_answer:0
     }
     newAnswers.value.push(newAnswer);
}
function handleRadioToggle(id){
     selectedAnswer.value=id
     newAnswers.value.forEach(answer => {
               if(answer.id===id) answer.correct_answer=1
               else answer.correct_answer=0
     })
}
function submitQuestion() {
     if(!createdQuestion.value){
          alert('dasdas')
          return false;
     }
     router.post('/questions',{
          question:createdQuestion.value,
          answers:newAnswers.value
     })
     router.on('success',() => {
          createdQuestion.value=null,
          newAnswers.value=[]
     })
}
</script>

<template>
    <Layout>
        <button @click="createQuestion()" class="btn btn-primary">
            Create
        </button>
        <table class="table table-striped">
            <thead>
                <tr>
                    <td scope="row">huy></td>
                    <td scope="row">>huy</td>
                    <td scope="row">>huy</td>
                    <td scope="row">>huy</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </Layout>
    <Teleport to="body">
        <NewQuestionModal :show="showNewQuestionModal" @close="destroyModal">
            <template #header> Thêm mới câu hỏi </template>
            <template #success> 
               <div v-if="success" class="alert alert-success">
                    {{ success }}
               </div>
            </template>

            <template #body>
                <form>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input
                            type="text"
                            v-model="createdQuestion"
                            class="form-control"
                            id="exampleInputEmail1"
                        />
                    </div>
                </form>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <td scope="row">#</td>
                            <td scope="row">Answer</td>
                            <td scope="row">Correct</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(answer,index) in newAnswers">
                            <td>1</td>
                            <td>
                                <input
                                v-model="answer.answer"
                                    type="text"
                                    class="form-control"
                                    >
                            </td>
                            <td>
                                <input type="radio" :check="answer.correct_answer===1" class="form-check-input" :value="answer.id"  @change="handleRadioToggle(answer.id)"/>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </template>
            <template #footer>
               <button @click="addNewAnswer" v-if="newAnswers.length<4">Them</button>
                <button @click="submitQuestion" v-if="newAnswers.length>3" class="btn btn-primary">Create</button>
                <button @click="destroyModal" class="btn btn-danger">Close</button>
            </template>
        </NewQuestionModal>
    </Teleport>
</template>
