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
            <tr v-for="(ingredient, key) in ingredients">
                <td>
                    <label>
                        <input :name="`recipe_ingredients[${key}][quantity]`" class="form-control" min="1"
                               type="number" v-model="ingredient.quantity">
                    </label>
                </td>
                <td>
                    <label>
                        <select :name="`recipe_ingredients[${key}][measure_unit_id]`" class="form-control"
                                v-model="ingredient.unit">
                            <option :value="unit.id" v-for="unit in unitsList">{{unit.name}}</option>
                        </select>
                    </label>
                </td>
                <td>
                    <label>
                        <select :name="`recipe_ingredients[${key}][ingredient_id]`" class="form-control"
                                v-model="ingredient.ingredient">
                            <option :value="ingredient.id" v-for="ingredient in ingredientsList">{{ingredient.name}}
                            </option>
                        </select>
                    </label>
                </td>
                <td>
                    <button @click.prevent="removeIngredient(key)" class="btn btn-danger">-</button>
                </td>
            </tr>
            </tbody>
        </table>
        <button @click.prevent="addIngredient" class="btn btn-success">+</button>
    </div>
</template>

<script>
    export default {
        props: {
            ingredientsList: Array,
            unitsList: Array,
            ingredientsOld: {
                type: Array,
                default: function () {
                    return [{
                        quantity: 0,
                        ingredient: null,
                        unit: null,
                    }];
                }
            }
        },
        data() {
            return {
                ingredients: this.ingredientsOld
            }
        },
        methods: {
            addIngredient() {
                this.ingredients.push({
                    quantity: 0,
                    ingredient: null,
                    unit: null,
                })
            },
            removeIngredient(key) {
                if (this.ingredients.length > 1)
                    this.ingredients.splice(key, 1);
            }
        }
    }
</script>
