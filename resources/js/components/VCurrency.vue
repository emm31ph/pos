 <template >
  <input autocomplete="off" type="text" @keydown.up.prevent="increment" @keydown.down.prevent="decrement" :value="active ? val : formatted" @blur="update" @keyup.enter.stop="update" @focus="active = true" :disabled="disabled" />
</template>

<script>
export default {
  name: "VCurrency",
  // model: { event: "blur" },
  props: {
    value: { type: Number, default: 0 },
    min: { type: Number, default: 0 },
    max: { type: Number, default: 100000000 },
    step: { type: Number, default: 10000 },
    decimals: { type: Number, default: 0 },
    type: { default: "currency" },
    disabled: { type: Boolean, default: false },
  },
  data: function () {
    return {
      active: false,
      _value: null,
    };
  },
  computed: {
    val: function () {
      if (this.type === "currency") {
        return Number(this.value) + "";
      } else if (this.type === "years") {
        return Number(this.value) + "";
      } else if (this.type === "percent") {
        return Number(this.value * 100).toFixed(this.decimals);
      }
    },
    formatted: function () {
      if (this.type === "currency") {
        return this.formatAsCurrency1(this.value, 0);
      } else if (this.type === "years") {
        return Number(this.value + "".replace(/[^0-9\.]+/g, "")) + " Years";
      } else if (this.type === "percent") {
        if (this.value !== 0) {
          return (this.value * 100).toFixed(this.decimals) + "%";
        }
        return "";
      }
    },
  },
  methods: {
    formatAsCurrency1(value, dec) {
      if (value == 0) {
        return null;
      }
      dec = dec || 0;
      if (dec != 0) {
        return value.toFixed(dec).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
      }
      return Number(value).toLocaleString();
    },
    increment: function (e) {
      if (e.shiftKey) {
        this._value += 10 * this.step;
      } else {
        this._value += this.step;
      }
      if (this.value > this.max) {
        this._value = this.max;
      }
      this.changed();
    },
    decrement: function (e) {
      if (e.shiftKey) {
        this._value -= 10 * this.step;
      } else {
        this._value -= this.step;
      }
      if (this.value < this.min) {
        this._value = this.min;
      }
      this.changed();
    },
    update: function () {
      this.active = false;
      var tempVal = this.$el.value + "";
      this._value = Number(tempVal.replace(/[^0-9\.]+/g, ""));
      if (this.type === "percent") this._value /= 100;
      this.changed();
    },
    changed: function () {
      this.$emit("input", Number(this._value));
    },
  },
  mounted() {
    this._value = this.value * 1;
  },
};
</script>

<style>
</style>