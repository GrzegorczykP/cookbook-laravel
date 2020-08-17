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
                </td>
                <td>
                    <label><textarea class="form-control px-3 " cols="48"
                                     :name="`steps[${key}][instruction]`" required rows="3"
                                     v-model="step.instruction"></textarea></label>
                </td>
                <td>
                    <label><input :id="`steps[${key}][picture]`" :name="`steps[${key}][picture]`"
                                  accept="image/jpeg, image/jpg, image/png" class="custom-file" type="file"></label>
                </td>
                <td>
                    <button @click.prevent="removeStep(key)" class="btn btn-danger">-</button>
                </td>
            </tr>
            </tbody>
        </table>
        <button @click.prevent="addStep" class="btn btn-success">+</button>
    </div>
</template>

<script>
    export default {
        props: {
            stepsOld: {
                type: Array,
                default: function () {
                    return [{
                        instruction: '',
                        picture: null,
                    }];
                }
            }
        },
        data() {
            return {
                steps: this.stepsOld
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
