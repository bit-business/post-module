<template>
  <div>
    <skijasi-breadcrumb-row>
      <template slot="action">
        <vs-button
          color="danger"
          type="relief"
          v-if="selected.length > 0 && $helper.isAllowed('delete_comments')"
          @click.stop
          @click="confirmDeleteMultiple"
          ><vs-icon icon="delete_sweep"></vs-icon>
          {{ $t("action.bulkDelete") }}</vs-button
        >
      </template>
    </skijasi-breadcrumb-row>
    <vs-row v-if="$helper.isAllowed('browse_comments')">
      <vs-col vs-lg="12">
        <vs-card>
          <div slot="header">
            <h3>{{ $t("comment.title") }}</h3>
          </div>
          <div>
            <skijasi-table
              multiple
              v-model="selected"
              pagination
              max-items="10"
              search
              :data="comments"
              stripe
              description
              :description-items="descriptionItems"
              :description-title="$t('comment.footer.descriptionTitle')"
              :description-connector="$t('comment.footer.descriptionConnector')"
              :description-body="$t('comment.footer.descriptionBody')"
            >
              <template slot="thead">
                <vs-th sort-key="title"> {{ $t("comment.header.user") }} </vs-th>
                <vs-th sort-key="slug"> {{ $t("comment.header.comment") }} </vs-th>
                <vs-th sort-key="metaTitle"> {{ $t("comment.header.post") }} </vs-th>
                <vs-th sort-key="metaTitle"> {{ $t("comment.header.submit") }} </vs-th>
                <vs-th> {{ $t("comment.header.action") }} </vs-th>
              </template>

              <template slot-scope="{ data }">
                <vs-tr :data="tr" :key="indextr" v-for="(tr, indextr) in data">
                  <vs-td :data="tr.user">
                    {{ tr.user.name }}
                  </vs-td>
                  <vs-td :data="tr.content">
                    {{ tr.content }}
                  </vs-td>
                  <vs-td :data="tr.post">
                    {{ tr.post !== null ? tr.post.title : null }}
                  </vs-td>
                  <vs-td :data="tr.createdAt">
                    {{ tr.createdAt }}
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
                            name: 'CommentRead',
                            params: { id: tr.id },
                          }"
                          v-if="$helper.isAllowed('read_comments')"
                        >
                          Detail
                        </skijasi-dropdown-item>
                        <skijasi-dropdown-item
                          icon="edit"
                          :to="{
                            name: 'CommentEdit',
                            params: { id: tr.id },
                          }"
                          v-if="$helper.isAllowed('edit_comments')"
                        >
                          Edit
                        </skijasi-dropdown-item>
                        <skijasi-dropdown-item
                          icon="delete"
                          @click="confirmDelete(tr.id)"
                          v-if="$helper.isAllowed('delete_comments')"
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
  name: "CommentBrowse",
  components: {},
  data: () => ({
    selected: [],
    descriptionItems: [10, 50, 100],
    comments: [],
    willDeleteId: null,
  }),
  mounted() {
    this.getCommentList();
  },
  methods: {
    confirmDelete(id) {
      this.willDeleteId = id;
      this.$vs.dialog({
        type: "confirm",
        color: "danger",
        title: this.$t("action.delete.title"),
        text: this.$t("action.delete.text"),
        accept: this.deleteComment,
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
        accept: this.bulkDeleteComment,
        acceptText: this.$t("action.delete.accept"),
        cancelText: this.$t("action.delete.cancel"),
        cancel: () => {},
      });
    },
    getCommentList() {
      this.$openLoader();
      this.$api.skijasiComment
        .browse()
        .then((response) => {
          this.$closeLoader();
          this.selected = [];
          this.comments = response.data.comments;
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
    deleteComment() {
      this.$openLoader();
      this.$api.skijasiComment
        .delete({
          id: this.willDeleteId,
        })
        .then((response) => {
          this.$closeLoader();
          this.getCommentList();
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
    bulkDeleteComment() {
      const ids = this.selected.map((item) => item.id);
      this.$openLoader();
      this.$api.skijasiComment
        .deleteMultiple({
          ids: ids.join(","),
        })
        .then((response) => {
          this.$closeLoader();
          this.getCommentList();
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
