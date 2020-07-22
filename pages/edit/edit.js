import request from '../../utils/request'

Page({

  /**
   * 页面的初始数据
   */
  data: {
    index:0,
    CateArray: [],
    id:0,
    info:null
  },
  //生命周期钩子
  onLoad:function(opt)
  {
    var that = this  //onLoad

    if(typeof(opt.id) == "undefined")
    {
      //返回上一个界面
      wx.navigateTo({
        delta: 1
      })
    }else{
      that.setData({
        id:opt.id
      })
    }

    //发送一个get请求 then然后
    request.get('/add.php?action=catelist').then(function(result){
      that.setData({
        CateArray:result
      })

      //获取当前名片的详细信息
      that.info()
    })
  },
  changeCate(event)
  {
    //修改data里面的index数据
    this.setData({
      index:event.detail.value
    })
  },
  //表单提交方法
  ok(e)
  {
    var data = e.detail.value
    var that = this

    //验证用户名是否为空
    var regu = "^[ ]+$";  //正则表达式
    var re = new RegExp(regu);

    if(re.test(data.username))
    {
      wx.showToast({
        title:'用户名不能为空',
        icon:'none',
        duration:2000
      })
      return false
    }

    //验证个人介绍不能为空
    if(re.test(data.content))
    {
      wx.showToast({
        title:'个人介绍不能为空',
        icon:'none',
        duration:2000
      })
      return false
    }

    //验证手机号码
    if(!(/^1[3456789]\d{9}$/.test(data.phone)))
    {
      wx.showToast({
        title:'手机号码输入有误，请重新填写',
        icon:'none',
        duration:2000
      })
      return false
    }

    var index = this.data.index
    var cateid = this.data.CateArray[index].id

    //组装数据
    var RequestData = {
      'id':that.data.id,
      'username':data.username,
      'phone':data.phone,
      'content':data.content,
      'cateid':cateid
    }

    //将数据发送给后端插入到数据库
    request.post('/edit.php?action=edit',RequestData).then(function(res){
      if(res.result)
      {
        //成功
        wx.switchTab({
          url: '/pages/index/index'
        })

      }else{
        //失败
        wx.showToast({
          title:res.msg,
          icon:'none',
          duration:2000
        })
      }
    })
  },
  //获取当前点击的名片记录
  info()
  {
    var that = this
    var id = this.data.id
    //发送一个get请求 then然后
    request.get(`/edit.php?action=info&id=${id}`).then(function(res){
      if(res.result)
      {
        //获取分类id
        var cateid = res.msg.cateid

        for(var key in that.data.CateArray)
        {
          if(that.data.CateArray[key].id == cateid)
          {
            that.setData({
              index:key
            })
          }
        }

        //将查询到的信息给到这个人
        that.setData({
          info:res.msg
        })
      }else{
        //跳转
        wx.switchTab({
          url: '/pages/index/index'
        })
      }
    })
  }

  
})