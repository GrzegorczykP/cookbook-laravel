<template>
    <div>
        <label>Przygotowanie:</label>
        <table>
            <thead>
            <tr>
                <th><label>Krok</label></th>
                <th><label>Instrukcje</label></th>
                <th><label>Zdjęcie</label></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(step, key) in steps">
                <td>
                    {{ key + 1 }}
                    <input name="steps[][order]" type="hidden" v-model="step.index">
                </td>
                <td>
                    <label><textarea class="form-control px-3 " cols="48"
                                     name="steps[][instructions]" required rows="3"
                                     v-model="step.instruction"></textarea></label>
                </td>
                <td>
                    <label><input accept="image/jpeg, image/jpg, image/png" class="custom-file" id="picture"
                                  name="steps[][picture]" type="file"></label>
                </td>
                <td>
                    <button @click="removeStep(key)" class="btn btn-danger">-</button>
                </td>
            </tr>
            </tbody>
        </table>
        <button @click="addStep" class="btn btn-success">+</button>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                steps: [{
                    instruction: '',
                    picture: null,
                }]
            }
        },
        methods: {
            addStep() {
                this.steps.push({
                    instruction: '',
                    picture: null,
                })
            },
            removeStep(key) {
                if (this.steps.length > 1)
                    this.steps.splice(key, 1);
            }
        }
    }
</script>
