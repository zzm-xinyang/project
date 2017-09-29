using System;
using System.Collections;
using System.Collections.Generic;
using System.Text;
namespace Monitor
{
    #region Tassesses
    public class Tassesses
    {
        #region Member Variables
        protected int _id;
        protected int _pid;
        protected string _assess;
        protected int _assesstime;
        #endregion
        #region Constructors
        public Tassesses() { }
        public Tassesses(int pid, string assess, int assesstime)
        {
            this._pid=pid;
            this._assess=assess;
            this._assesstime=assesstime;
        }
        #endregion
        #region Public Properties
        public virtual int Id
        {
            get {return _id;}
            set {_id=value;}
        }
        public virtual int Pid
        {
            get {return _pid;}
            set {_pid=value;}
        }
        public virtual string Assess
        {
            get {return _assess;}
            set {_assess=value;}
        }
        public virtual int Assesstime
        {
            get {return _assesstime;}
            set {_assesstime=value;}
        }
        #endregion
    }
    #endregion
}