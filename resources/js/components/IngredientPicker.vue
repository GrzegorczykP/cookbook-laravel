<template>
    <div>
        <label>Składniki:</label>
        <table>
            <thead>
            <tr>
                <th><label>Ilość</label></th>
                <th><label>Jednostka</label></th>
                <th><label>Składnik</label></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(ingredient, index) in ingredients">
                <td>
                    <label>
                        <input class="form-control" min="1" name="ingredients[][quantity]" required
                               type="number" v-model="ingredient.quantity">
                    </label>
                </td>
                <td>
                    <label>
                        <select class="form-control" name="ingredients[][unit]" required v-model="ingredient.unitId">
                            <option :value="unit.id" v-for="unit in unitsList">{{unit.name}}</option>
                        </select>
                    </label>
                </td>
                <td>
                    <label>
                        <select class="form-control" name="ingredients[][ingredient]" required
                                v-model="ingredient.ingredientId">
                            <option :value="ingredient.id" v-for="ingredient in ingredientsList">{{ingredient.name}}
                            </option>
                        </select>
                    </label>
                </td>
                <td>
                    <button @click="removeIngredient(index)" class="btn btn-danger">-</button>
                </td>
            </tr>
            </tbody>
        </table>
        <button @click="addIngredient" class="btn btn-success">+</button>
    </div>
</template>

<script>
    export default {
        props: {
            ingredientsList: Array,
            unitsList: Array,
        },
        data() {
            return {
                ingredients: [{
                    index: 0,
                    quantity: 0,
                    ingredientId: null,
                    unitId: null,
                }],
            }
        },
        methods: {
            addIngredient() {
                let index = this.ingredients.length;
                this.ingredients.push({
                    index: index,
                    quantity: 0,
                    ingredientId: null,
                    unitId: null,
                })
            },
            removeIngredient(key) {
                if (this.ingredients.length > 1)
                    this.ingredients.splice(key, 1);
            }
        }
    }
</script>
