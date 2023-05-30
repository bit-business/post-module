<template>
  <div>
    <skijasi-breadcrumb-row>
      <template slot="action">
        <vs-button
          color="primary"
          type="relief"
          :to="{ name: 'TagsAdd' }"
          v-if="$helper.isAllowed('add_tags')"
          ><vs-icon icon="add"></vs-icon> {{ $t("action.add") }}</vs-button
        >
        <vs-button
          color="danger"
          type="relief"
          v-if="selected.length > 0 && $helper.isAllowed('delete_tags')"
          @click.stop
          @click="confirmDeleteMultiple"
          ><vs-icon icon="delete_sweep"></vs-icon>
          {{ $t("action.bulkDelete") }}</vs-button
        >
      </template>
    </skijasi-breadcrumb-row>
    <vs-row v-if="$helper.isAllowed('browse_tags')">
      <vs-col vs-lg="12">
        <vs-card>
          <div slot="header">
            <h3>{{ $t("tags.title") }}</h3>
          </div>
          <div>
            <skijasi-table
              multiple
              v-model="selected"
              pagination
              max-items="10"
              search
              :data="tags"
              stripe
              description
              :description-items="descriptionItems"
              :description-title="$t('tags.footer.descriptionTitle')"
              :description-connector="$t('tags.footer.descriptionConnector')"
              :description-body="$t('tags.footer.descriptionBody')"
            >
              <template slot="thead">
                <vs-th sort-key="title"> {{ $t("tags.header.title") }} </vs-th>
                <vs-th sort-key="metaTitle"> {{ $t("tags.header.metaTitle") }} </vs-th>
                <vs-th sort-key="slug"> {{ $t("tags.header.slug") }} </vs-th>
                <vs-th> {{ $t("tags.header.action") }} </vs-th>
              </template>

              <template slot-scope="{ data }">
                <vs-tr :data="tr" :key="indextr" v-for="(tr, indextr) in data">
                  <vs-td :data="tr.title">
                    {{ tr.title }}
                  </vs-td>
                  <vs-td :data="tr.metaTitle">
                    {{ tr.metaTitle }}
                  </vs-td>
                  <vs-td :data="tr.slug">
                    {{ tr.slug }}
                  </vs-td>
                  <vs-td style="width: 1%; white-space: nowrap">
                    <skijasi-dropdown vs-trigger-click>
                      <vs-button
                        size="large"
                        type="flat"
                        icon="more_vert"
                      ></vs-button>
                      <vs-dropdown-menu>
                        <skijasi-dropdown-item
                          icon="visibility"
                          :to="{
                            name: 'TagsRead',
                            params: { id: tr.id },
                          }"
                          v-if="$helper.isAllowed('read_tags')"
                        >
                          Detail
                        </skijasi-dropdown-item>
                        <skijasi-dropdown-item
                          icon="edit"
                          :to="{
                            name: 'TagsEdit',
                            params: { id: tr.id },
                          }"
                          v-if="$helper.isAllowed('edit_tags')"
                        >
                          Edit
                        </skijasi-dropdown-item>
                        <skijasi-dropdown-item
                          icon="delete"
                          @click="confirmDelete(tr.id)"
                          v-if="$helper.isAllowed('delete_tags')"
                        >
                          Delete
                        </skijasi-dropdown-item>
                      </vs-dropdown-menu>
                    </skijasi-dropdown>
                  </vs-td>
                </vs-tr>
              </template>
            </skijasi-table>
          </div>
        </vs-card>
      </vs-col>
    </vs-row>
  </div>
</template>

<script>
export default {
  name: "TagsBrowse",
  components: {},
  data: () => ({
    selected: [],
    descriptionItems: [10, 50, 100],
    tags: [],
    willDeleteId: null,
  }),
  mounted() {
    this.getTagsList();
  },
  methods: {
    confirmDelete(id) {
      this.willDeleteId = id;
      this.$vs.dialog({
        type: "confirm",
        color: "danger",
        title: this.$t("action.delete.title"),
        text: this.$t("action.delete.text"),
        accept: this.deleteTags,
        acceptText: this.$t("action.delete.accept"),
        cancelText: this.$t("action.delete.cancel"),
        cancel: () => {
          this.willDeleteId = null;
        },
      });
    },
    confirmDeleteMultiple(id) {
      this.$vs.dialog({
        type: "confirm",
        color: "danger",
        title: this.$t("action.delete.title"),
        text: this.$t("action.delete.text"),
        accept: this.bulkDeleteTags,
        acceptText: this.$t("action.delete.accept"),
        cancelText: this.$t("action.delete.cancel"),
        cancel: () => {},
      });
    },
    getTagsList() {
      this.$openLoader();
      this.$api.skijasiTags
        .browse()
        .then((response) => {
          this.$closeLoader();
          this.selected = [];
          this.tags = response.data.tags;
        })
        .catch((error) => {
          this.$closeLoader();
          this.$vs.notify({
            title: this.$t("alert.danger"),
            text: error.message,
            color: "danger",
          });
        });
    },
    deleteTags() {
      this.$openLoader();
      this.$api.skijasiTags
        .delete({
          id: this.willDeleteId,
        })
        .then((response) => {
          this.$closeLoader();
          this.getTagsList();
        })
        .catch((error) => {
          this.$closeLoader();
          this.$vs.notify({
            title: this.$t("alert.danger"),
            text: error.message,
            color: "danger",
          });
        });
    },
    bulkDeleteTags() {
      const ids = this.selected.map((item) => item.id);
      this.$openLoader();
      this.$api.skijasiTags
        .deleteMultiple({
          ids: ids.join(","),
        })
        .then((response) => {
          this.$closeLoader();
          this.getTagsList();
        })
        .catch((error) => {
          this.$closeLoader();
          this.$vs.notify({
            title: this.$t("alert.danger"),
            text: error.message,
            color: "danger",
          });
        });
    },
  },
};
</script>
